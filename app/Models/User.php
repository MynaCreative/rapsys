<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

use Exception;

use App\Traits\Scope as GeneralScope;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, SoftDeletes, Notifiable, HasRoles, AuthenticationLoggable, GeneralScope;

    const POSITION_VP           = 1;
    const POSITION_MANAGER      = 2;
    const POSITION_SPECIALIST   = 3;
    const POSITION_STAFF        = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'position',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'position_text'
    ];

    /**
     * Set the user's password.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value),
        );
    }

    /**
     * Get the user's position text.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function positionText(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $text = null;
                if(isset($attributes['position'])){
                    $position = $attributes['position'];
                    switch ($position) {
                        case self::POSITION_VP:
                            $text = 'VP';
                            break;
                        case self::POSITION_MANAGER:
                            $text = 'Manager';
                            break;
                        case self::POSITION_SPECIALIST:
                            $text = 'Specialist';
                            break;
                        case self::POSITION_STAFF:
                            $text = 'Staff';
                            break;
                        default:
                            $text = '';
                    }
                    // match ($position) {
                    //     self::POSITION_VP           => $text = 'VP',
                    //     self::POSITION_MANAGER      => $text = 'Manager',
                    //     self::POSITION_SPECIALIST   => $text = 'Specialist',
                    //     self::POSITION_STAFF        => $text = 'Staff',
                    //     default => throw new Exception(
                    //         message: "$position is not supported yet.",
                    //     ),
                    // };
                }
                return $text;
            },
        );
    }
}
