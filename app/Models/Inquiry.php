<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $table = 'inquiries';

    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'vehicle_type',
        'interested_package',
        'message',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
