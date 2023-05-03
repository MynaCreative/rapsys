<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use App\Traits\Signature;
use App\Traits\Scope as GeneralScope;

class Workflow extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, GeneralScope, Signature;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['department_id', 'code', 'name', 'description'];

    /**
     * Get the department that owns the workflow.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the items for the workflow.
     */
    public function items()
    {
        return $this->hasMany(WorkflowItem::class)->orderBy('sequence')->orderBy('range_from')->orderBy('range_to');
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
