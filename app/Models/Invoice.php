<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use App\Traits\Signature;
use App\Traits\Scope as GeneralScope;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Invoice extends Model
{
    use HasFactory, LogsActivity, GeneralScope, Signature;

    const DOCUMENT_STATUS_DRAFT     = 'draft';
    const DOCUMENT_STATUS_PUBLISHED = 'published';
    const DOCUMENT_STATUS_CANCELLED = 'cancelled';
    const DOCUMENT_STATUS_CLOSED    = 'closed';

    const APPROVAL_STATUS_NONE      = 'none';
    const APPROVAL_STATUS_PENDING   = 'pending';
    const APPROVAL_STATUS_APPROVED  = 'approved';
    const APPROVAL_STATUS_REJECTED  = 'rejected';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'code',

        'invoice_type_id',
        'department_id',
        'currency_id',
        'interco_id',
        'vendor_id',
        'vendor_site_id',
        'term_id',
        'sbu_id',

        'invoice_number',
        'supplier_tax_invoice',

        'posting_date',
        'invoice_date',
        'invoice_receipt_date',
        'supplier_tax_invoice_date',

        'term_date',
        'due_date',

        'total_item',
        'total_item_validated',
        'total_amount',
        'total_amount_valid',
        'total_amount_invalid',
        'total_amount_after_tax',
        'total_amount_after_tax_valid',
        'total_amount_after_tax_invalid',

        'document_status',
        'approval_status',
        'document_status_time',
        'approval_status_time',

        'note',
        'cancel_remark',
        'reject_remark',

        'published_at',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'total_amount'                      => 'float',
        'total_amount_valid'                => 'float',
        'total_amount_invalid'              => 'float',
        'total_amount_after_tax'            => 'float',
        'total_amount_after_tax_valid'      => 'float',
        'total_amount_after_tax_invalid'    => 'float',

        'document_status_time'              => 'datetime',
        'approval_status_time'              => 'datetime',
        'published_at'                      => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'dists'
    ];

    /**
     * Get the user's type text.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function dists(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $items = [];
                $taxes = [];
                if ($this->invoiceExpenses) {
                    foreach ($this->invoiceExpenses as $expense) {
                        if ($expense->type == InvoiceExpense::TYPE_AWB) {
                            $dists = $expense->awbItems;
                            $distGroups = $dists->groupBy('dist');
                            foreach ($distGroups as $group) {
                                $item = $group->first();
                                if ($item->product && $item->area) {
                                    $description = implode('|', array_filter([
                                        $expense->expense->code,
                                        $group->count() . $item->type,
                                        $item->product->code ?? null,
                                        $item->area->code ?? null
                                    ]));
                                    $amount = $group->sum('amount');
                                    $withholding = ($item->withholding->deduction ?? 0) * $amount;
                                    $tax = ($item->tax->deduction ?? 0) * $amount;
                                    $items[] = [
                                        'description' => $description,
                                        'line_type_code' => 'ITEM',
                                        'ppn_code' => $item->tax->name ?? null,
                                        'tax_rate_id' => $item->tax->code ?? null,
                                        'awt_group_id' => $item->withholding->code ?? null,
                                        'awt_group_name' => $item->withholding->name ?? null,
                                        'ppn_code' => $item->tax->name ?? null,
                                        'amount' => $amount,
                                        'amount_withholding' => $withholding,
                                        'amount_tax' => $tax,
                                        'amount_after_tax' => $amount + $tax,
                                        'amount_after_wht' => $amount - $withholding + $tax,
                                        'dist_code_concat' => $item->dist,
                                    ];
                                }
                            };
                        }
                        if ($expense->type == InvoiceExpense::TYPE_SMU) {
                            $dists = $expense->awbItems;
                            $distGroups = $dists->groupBy('dist');
                            foreach ($distGroups as $group) {
                                $item = $group->first();
                                if ($item->product && $item->area) {
                                    $description = implode('|', array_filter([
                                        $expense->expense->code,
                                        $group->count() . $item->type,
                                        $item->product->code ?? null,
                                        $item->area->code ?? null
                                    ]));
                                    $amount = $group->sum('amount');
                                    $withholding = ($item->withholding->deduction ?? 0) * $amount;
                                    $tax = ($item->tax->deduction ?? 0) * $amount;
                                    $items[] = [
                                        'description' => $description,
                                        'line_type_code' => 'ITEM',
                                        'ppn_code' => $item->tax->name ?? null,
                                        'tax_rate_id' => $item->tax->code ?? null,
                                        'awt_group_id' => $item->withholding->code ?? null,
                                        'awt_group_name' => $item->withholding->name ?? null,
                                        'ppn_code' => $item->tax->name ?? null,
                                        'amount' => $amount,
                                        'amount_withholding' => $withholding,
                                        'amount_tax' => $tax,
                                        'amount_after_tax' => $amount + $tax,
                                        'amount_after_wht' => $amount - $withholding + $tax,
                                        'dist_code_concat' => $item->dist,
                                    ];
                                }
                            };
                        }
                    }
                }
                if ($this->items) {
                    $dists = $this->items;
                    $distGroups = $dists->groupBy('dist');
                    foreach ($distGroups as $group) {
                        $item = $group->first();
                        if ($item->product && $item->area) {
                            $description = implode('|', array_filter([
                                $item->expense->code,
                                $group->count(),
                                $item->product->code ?? null,
                                $item->area->code ?? null
                            ]));
                            $amount = $group->sum('amount');
                            $withholding = ($item->withholding->deduction ?? 0) * $amount;
                            $tax = ($item->tax->deduction ?? 0) * $amount;
                            $items[] = [
                                'description' => $description,
                                'line_type_code' => 'ITEM',
                                'ppn_code' => $item->tax->name,
                                'tax_rate_id' => $item->tax->code,
                                'awt_group_id' => $item->withholding->code ?? null,
                                'awt_group_name' => $item->withholding->name ?? null,
                                'ppn_code' => $item->tax->name,
                                'amount' => $amount,
                                'amount_withholding' => $withholding,
                                'amount_tax' => $tax,
                                'amount_after_tax' => $amount + $tax,
                                'amount_after_wht' => $amount - $withholding + $tax,
                                'dist_code_concat' => $item->dist,
                            ];
                        }
                    };
                }
                // if ($this->awbItems || $this->items) {
                //     $dists = collect([$this->awbItems])->reduce(function ($arr, $item) {
                //         if (empty($item) || $item->isEmpty())
                //             return $arr;
                //         return $arr->merge($item);
                //     }, $this->items);
                //     $dists = $this->awbItems;
                //     $distGroups = $dists->groupBy('dist');
                //     foreach ($distGroups as $group) {
                //         $item = $group->first();
                //         $awb = $item->code;
                //         $description = implode('|', array_filter([
                //             $item->expense->code,
                //             $group->count() . $item->type,
                //             $awb,
                //             $item->area->code ?? null
                //         ]));
                //         $amount = $group->sum('amount');
                //         $withholding = ($item->withholding->deduction ?? 0) * $amount;
                //         $tax = ($item->tax->deduction ?? 0) * $amount;
                //         $items[] = [
                //             'description' => $description,
                //             'line_type_code' => 'ITEM',
                //             'ppn_code' => $item->tax->name,
                //             'tax_rate_id' => $item->tax->code,
                //             'awt_group_id' => $item->withholding->code,
                //             'awt_group_name' => $item->withholding->name,
                //             'ppn_code' => $item->tax->name,
                //             'amount' => $amount,
                //             'amount_withholding' => $withholding,
                //             'amount_tax' => $tax,
                //             'amount_after_tax' => $amount + $tax,
                //             'amount_after_wht' => $amount - $withholding + $tax,
                //             'dist_code_concat' => $item->dist,
                //         ];
                //         if ($item->tax) {
                //             $taxes[] = [
                //                 'description' => $description,
                //                 'line_type_code' => 'TAX',
                //                 'ppn_code' => $item->tax->name,
                //                 'tax_rate_id' => $item->tax->code,
                //                 'amount' => $item->tax->deduction * $amount,
                //             ];
                //         }
                //     };
                // }
                // if (count($taxes) > 0) {
                //     $taxes = collect($taxes)->groupBy('ppn_code')->map(function ($tax) {
                //         $item = $tax->first();
                //         return [
                //             'description' => $item['ppn_code'],
                //             'line_type_code' => 'TAX',
                //             'ppn_code' => $item['ppn_code'],
                //             'tax_rate_id' => $item['tax_rate_id'],
                //             'amount' => $tax->sum('amount'),
                //         ];
                //     })->values()->all();
                // }
                return [
                    'items' => $items,
                    'taxes' => $taxes,
                ];
            },
        );
    }

    /**
     *
     * @param  string  $value
     * @return void
     */
    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = $value;
        $id = DB::table('INFORMATION_SCHEMA.TABLES')->select('AUTO_INCREMENT as id')
            ->where('TABLE_SCHEMA', DB::connection()->getDatabaseName())
            ->where('TABLE_NAME', (new self)->getTable())
            ->value('id');
        $this->attributes['code'] = 'INV' . sprintf('%06d', $id);
    }

    /**
     * Get the department tax that owns the invoice item.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the invoice type that owns the invoice.
     */
    public function invoiceType()
    {
        return $this->belongsTo(InvoiceType::class);
    }

    /**
     * Get the currency that owns the invoice.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Get the interco that owns the invoice.
     */
    public function interco()
    {
        return $this->belongsTo(Interco::class);
    }

    /**
     * Get the vendor that owns the invoice.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get the vendor site that owns the invoice.
     */
    public function vendorSite()
    {
        return $this->belongsTo(VendorSite::class);
    }

    /**
     * Get the term that owns the invoice.
     */
    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    /**
     * Get the sbu that owns the invoice.
     */
    public function sbu()
    {
        return $this->belongsTo(Sbu::class);
    }

    /**
     * Get the items for the invoice.
     */
    public function items()
    {
        return $this->hasMany(InvoiceItem::class)->latest();
    }

    /**
     * Get the smu items for the invoice.
     */
    public function smuItems()
    {
        return $this->hasMany(InvoiceSmu::class)->latest()->orderBy('validation_score')->orderByDesc('message');
    }

    /**
     * Get the awb items for the invoice.
     */
    public function awbItems()
    {
        return $this->hasMany(InvoiceAwb::class)->latest()->orderBy('validation_score')->orderByDesc('message');
    }

    /**
     * Get the expenses for the invoice.
     */
    public function expenses()
    {
        return $this->hasMany(InvoiceExpense::class);
    }

    /**
     * Get the expenses for the invoice.
     */
    public function invoiceExpenses()
    {
        return $this->hasMany(InvoiceExpense::class);
    }

    /**
     * Get the attachments for the invoice.
     */
    public function attachments()
    {
        return $this->hasMany(InvoiceAttachment::class);
    }

    /**
     * Get the approvals for the invoice.
     */
    public function approvals()
    {
        return $this->hasMany(Approval::class);
    }

    /**
     * Logging activity history.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName((new self)->getTable())
            ->logOnly($this->fillable)
            ->logOnlyDirty();
    }
}
