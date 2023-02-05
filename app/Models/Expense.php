<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use App\Traits\Signature;
use App\Traits\Scope as GeneralScope;

class Expense extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, GeneralScope, Signature;

    const TYPE_SMU  = 1;
    const TYPE_AWB  = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code','name','coa','coa_description','mandatory_scan','icon','description','type'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        // 'mandatory_scan' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'type_text'
    ];

    /**
     * Get the user's type text.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function typeText(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $text = null;
                if(isset($attributes['type'])){
                    $type = $attributes['type'];
                    switch ($type) {
                        case self::TYPE_SMU:
                            $text = 'SMU';
                            break;
                        case self::TYPE_AWB:
                            $text = 'AWB';
                            break;
                        default:
                            $text = '';
                    }
                    // match ($type) {
                    //     self::TYPE_SMU   => $text = 'SMU',
                    //     self::TYPE_AWB   => $text = 'AWB',
                    //     default => throw new Exception(
                    //         message: "$type is not supported yet.",
                    //     ),
                    // };
                }
                return $text;
            },
        );
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
