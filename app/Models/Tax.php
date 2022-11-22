<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use App\Traits\Signature;
use App\Traits\Scope as GeneralScope;

class Tax extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, GeneralScope, Signature;

    const TYPE_VAT_IN       = 1;
    const TYPE_VAT_OUT      = 2;
    const TYPE_WITHHOLDING  = 3;
    const TYPE_CREDIT       = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code','name','deduction','type','description'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'deduction' => 'float',
    ];


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
