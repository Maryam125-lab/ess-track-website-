<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    protected $table = 'service_orders';

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime',
        'raw_payload' => 'array',
    ];
}
