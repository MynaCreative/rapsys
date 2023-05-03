<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Signature;
use App\Traits\Scope as GeneralScope;

class Approval extends Model
{
    use HasFactory, SoftDeletes, Signature;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'workflow_id',
        'workflow_item_id',
        'invoice_id',
        'user_id',
        'current',
        'status',
        'sequence',
        'description',
        'note',
        'approved_at',
        'rejected_at',
    ];

    /**
     * Get the invoice that owns the approval.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Get the user that owns the approval.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the workflow that owns the approval.
     */
    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }

    /**
     * Get the workflow item that owns the approval.
     */
    public function workflowItem()
    {
        return $this->belongsTo(WorkflowItem::class);
    }
}
