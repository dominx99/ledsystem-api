<?php

namespace App\Domain\Users\Models;

use App\Database\Eloquent\Model;

class User extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'access_token',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
