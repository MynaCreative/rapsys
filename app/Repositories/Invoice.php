<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Maatwebsite\Excel\Facades\Excel;

use App\Models\Invoice as Model;
use App\Imports\DataImport;
use App\Helpers\Relationship;
use App\Exports\Invoice\Sample as SampleTemplate;

use App\Models\Area;
use App\Models\Currency;
use App\Models\Expense;
use App\Models\Interco;
use App\Models\InvoiceType;
use App\Models\Product;
use App\Models\Sbu;
use App\Models\Tax;
use App\Models\Term;
use App\Models\Vendor;
use App\Models\Withholding;

class Invoice
{
    private Model $model;

    static  $uploadPath = 'invoices';

    /**
     * Initialize the repository from model.
     *
     * @param Model $model
     * @return Invoice
     */
    public static function init(Model $model): Invoice
    {
        $instance = new self;
        $instance->model = $model;

        return $instance;
    }

    /**
     * Display all of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function all(Request $request)
    {
        $query = Model::ordering($request)
            ->filtering($request)
            ->searching($request, ['code', 'name'])
            ->with(['createdUser:id,name','updatedUser:id,name'])
            ->latest();

        return $query->paginate($request->per_page ?? 10)->withQueryString()
        ->through(function ($item) {
            return [
                'id'                    => $item->id,
                'code'                  => $item->code,
                'vendor'                => $item->vendor,
                'document_status'       => $item->document_status,
                'approval_status'       => $item->approval_status,
                'invoice_number'        => $item->invoice_number,
                'invoice_date'          => $item->invoice_date,
                'invoice_receipt_date'  => $item->invoice_receipt_date,
                'description'           => $item->description,
                'created_user'          => $item->createdUser,
                'updated_user'          => $item->updatedUser,
                'created_at'            => $item->created_at,
                'updated_at'            => $item->updated_at,
                'deleted_at'            => $item->deleted_at,
            ];
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function store($request): Model
    {
        $model = new Model($request->sanitizedData());
        $model->saveOrFail();

        /**
        * Document Item
        */
        self::saveDocumentItem($model, $request->items);

        /**
        * Document Attachment
        */
        self::saveDocumentAttachment($model, $request);

        return $model;
    }

    /**
     * Import to storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function import($request): void
    {
        $rows = Excel::toCollection(new DataImport, $request->file('excel_file'))
            ->first()
            ->toArray();
        DB::transaction(function () use ($rows) {
            foreach($rows as $row){
                Model::updateOrCreate(
                    ['code'=>$row['code']],
                    $row
                );
            }
        });
    }

    /**
     * Import to storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function importSample()
    {
        $date = now()->format('d-m-Y H:i:s');
        $name = str((new \ReflectionClass(__CLASS__))->getShortName())->kebab();
        return Excel::download(new SampleTemplate(), "{$name}-import-sample-{$date}.xlsx");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Model
     */
    public function update($request): Model
    {
        $this->model->fill($request->sanitizedData());
        $this->model->updateOrFail();

        /**
        * Document Item
        */
        self::saveDocumentItem($this->model, $request->items);

        /**
        * Document Attachment
        */
        self::deleteDocumentAttachment($this->model, $request);
        self::saveDocumentAttachment($this->model, $request, true);

        return $this->model;
    }

    /**
     * Display the specified resource.
     *
     * @return Model
     */
    public function show(): Model {
        return $this->model->load([
            'createdUser:id,name','updatedUser:id,name',
            'attachments'
        ]);
    }

    /**
     * Delete the specified resource from storage.
     *
     * @return bool|null
     */
    public function delete(): bool
    {
        return $this->model->deleteOrFail();
    }

    /**
     * Force Delete the specified resource from storage.
     *
     * @return bool|null
     */
    public function forceDelete(): bool
    {
        return $this->model->forceDelete();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @return bool|null
     */
    public function restore(): bool
    {
        return $this->model->restore();
    }

    /**
     * Data reference resource for this resource.
     *
     * @return array|null
     */
    public static function reference(): array
    {
        return [
            /** Header */
            'sbus' => Sbu::pluck('name','id'),
            'invoice_types' => InvoiceType::pluck('name','id'),
            'currencies' => Currency::pluck('name','id'),
            'intercos' => Interco::pluck('name','id'),
            'vendors' => Vendor::pluck('name','id'),
            'terms' => Term::pluck('name','id'),
            /** Item */
            'expenses' => Expense::select('id','icon','code','name')->get(),
            'products' => Product::pluck('name','id'),
            'areas' => Area::pluck('name','id'),
            'taxes' => Tax::pluck('name','id'),
            'withholdings' => Withholding::pluck('name','id'),
        ];
    }

    /**
     * Save items
     */
    public static function saveDocumentItem(Model $model, $items){
        if(!empty($items)) {
            Relationship::proccesRelationWithRequest(
                $model->items(),
                $items
            );
        }
    }

    /**
     * Add new attachments
     */
    public static function saveDocumentAttachment(Model $model, $request, $onUpdate = false){
        $attachments = [];
        $items = 'attachments';
        $has_attachments = $onUpdate ? $request->hasFile($items) : $request->attachments;
        if($has_attachments){
            foreach($request->file($items) as $attachment){
                $attachments[] = self::uploadFile($attachment);
            }
        }
        $model->attachments()->createMany($attachments);
    }

    /**
     * Delete attachments
     */
    public static function deleteDocumentAttachment(Model $model, $request){
        $requestAttachments = $request->attachments ? array_column($request->attachments, 'id') : [];
        $deletedAttachments = $model->attachments->whereNotIn('id',$requestAttachments);
        foreach($deletedAttachments as $item){
            self::deleteFile($item);
            $item->delete();
        }
    }

    /**
     * Upload File
     */
    public static function uploadFile($file){
        $path           = 'public/'.self::$uploadPath;
        $url            = 'storage/'.self::$uploadPath;
        $timestamp      = now()->format('YmdHs');
        $extension      = $file->getClientOriginalExtension();
        $type           = $file->getClientMimeType();
        $size           = $file->getSize();
        $nameOriginal   = $file->getClientOriginalName();
        $nameUpload     = $timestamp.'_'.str($nameOriginal)->slug().'.'.$extension;

        $file->storeAs($path, $nameUpload);

        return [
            'name'      => $nameOriginal,
            'storage'   => $nameUpload,
            'path'      => $path,
            'url'       => $url,
            'size'      => $size,
            'type'      => $type,
            'extension' => $extension,
        ];
    }

    /**
     * Delete File
     */
    public static function deleteFile($file){
        $path = 'public/'.self::$uploadPath;
        Storage::delete($path.'/'.$file->storage);
    }
}
