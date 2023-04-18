<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use App\Traits\Signature;
use App\Traits\Scope as GeneralScope;

class CostCenter extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, GeneralScope, Signature;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'cost_center', 'description'];


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
