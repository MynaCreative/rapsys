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

use Exception;

class Tax extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, GeneralScope, Signature;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code','name','deduction','description'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'deduction' => 'float',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        // 'type_text'
    ];

    /**
     * Get the user's position text.
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
                    // switch ($type) {
                    //     case self::TYPE_VAT_IN:
                    //         $text = 'Vat In';
                    //         break;
                    //     case self::TYPE_VAT_OUT:
                    //         $text = 'Vat Out';
                    //         break;
                    //     case self::TYPE_WITHHOLDING:
                    //         $text = 'Withholding';
                    //         break;
                    //     case self::TYPE_CREDIT:
                    //         $text = 'Credit';
                    //         break;
                    //     default:
                    //         $text = '';
                    // }
                    // match ($type) {
                    //     self::TYPE_VAT_IN       => $text = 'Vat In',
                    //     self::TYPE_VAT_OUT      => $text = 'Vat Out',
                    //     self::TYPE_WITHHOLDING  => $text = 'Withholding',
                    //     self::TYPE_CREDIT       => $text = 'Credit',
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
