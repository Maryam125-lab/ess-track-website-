<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortalUser extends Model
{
    protected $fillable = ['name', 'email', 'password_hash', 'is_active', 'last_login_at'];

    protected $hidden = ['password_hash'];

    protected $casts = [
        'is_active' => 'boolean',
        'last_login_at' => 'datetime',
    ];
}
