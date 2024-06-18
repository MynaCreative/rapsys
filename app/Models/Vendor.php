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

class Vendor extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, GeneralScope, Signature;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'sbu_id',
        'code',
        'name',
        'type',
        'description'
    ];

    /**
     *
     * @param  string  $value
     * @return void
     */
    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = $value;
        // $id = DB::table('INFORMATION_SCHEMA.TABLES')->select('AUTO_INCREMENT as id')
        //         ->where('TABLE_SCHEMA', DB::connection()->getDatabaseName())
        //         ->where('TABLE_NAME', (new self)->getTable())
        //         ->value('id');
        // $this->attributes['code'] = 'VDR'.sprintf('%03d', $id);
    }

    /**
     * Get the sbu that owns the vendor.
     */
    public function sbu()
    {
        return $this->belongsTo(Sbu::class);
    }

    /**
     * Get the sites for the vendor.
     */
    public function sites()
    {
        return $this->hasMany(VendorSite::class);
    }

    /**
     * Get the invoices for the department.
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class)->latest();
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
