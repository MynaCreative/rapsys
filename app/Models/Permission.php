<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as Model;
use App\Traits\Scope as GeneralScope;

class Permission extends Model
{
    use GeneralScope;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['permission_group_id','label','name','guard_name'];

    /**
     * Get the permission group that owns the permission.
     */
    public function permissionGroup()
    {
        return $this->belongsTo(PermissionGroup::class);
    }
}
