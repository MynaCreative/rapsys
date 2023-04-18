<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Area as Model;
use App\Exports\Area\Resource as ModelExport;
use App\Imports\DataImport;
use App\Exports\Area\Sample as SampleTemplate;

class Area
{
    private Model $model;

    /**
     * Initialize the repository from model.
     *
     * @param Model $model
     * @return Area
     */
    public static function init(Model $model): Area
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
        $query = Model::withTrashed()
            ->ordering($request)
            ->filtering($request)
            ->searching($request, ['code', 'name', 'coa'])
            ->with(['createdUser:id,name', 'updatedUser:id,name'])
            ->latest();

        return $query->paginate($request->per_page ?? 10)->withQueryString()
            ->through(function ($item) {
                return [
                    'id'            => $item->id,
                    'name'          => $item->name,
                    'code'          => $item->code,
                    'coa'           => $item->coa,
                    'description'   => $item->description,
                    'created_user'  => $item->createdUser,
                    'updated_user'  => $item->updatedUser,
                    'created_at'    => $item->created_at,
                    'updated_at'    => $item->updated_at,
                    'deleted_at'    => $item->deleted_at,
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
            foreach ($rows as $row) {
                Model::updateOrCreate(
                    ['code' => $row['code']],
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
     * Export a file from resource in storage.
     */
    public static function export($request)
    {
        $date = now()->format('Y-m-d');
        $name = str((new \ReflectionClass(__CLASS__))->getShortName())->kebab();
        $extension = str($request->type)->replace('dom', '');
        $fileName = "{$name}-{$date}.{$extension}";
        $data = Model::query()->get();

        if ($request->type != 'xlsx') {
            return self::renderPDF($data);
        } else {
            return self::renderExcel($request, $fileName, $data);
        }
    }

    /**
     * Render excel file.
     */
    public static function renderExcel($request, $fileName, $data)
    {
        return Excel::download(new ModelExport($data), $fileName, ucfirst($request->type));
    }

    /**
     * Render excel file.
     */
    public static function renderPDF($data)
    {
        $name = str((new \ReflectionClass(__CLASS__))->getShortName())->kebab();
        $pdf = PDF::loadView("pdf.{$name}.resource", [
            'rows' => $data,
        ]);

        $pdf->setOption('enable_php', true);

        return $pdf->stream();
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

        return $this->model;
    }

    /**
     * Display the specified resource.
     *
     * @return Model
     */
    public function show(): Model
    {
        return $this->model->load([
            'createdUser:id,name', 'updatedUser:id,name'
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
}
