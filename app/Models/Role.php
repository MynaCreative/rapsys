<?php

namespace App\Models;

use Spatie\Permission\Models\Role as Model;
use App\Traits\Scope as GeneralScope;

class Role extends Model
{
    use GeneralScope;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','guard_name'];
}
