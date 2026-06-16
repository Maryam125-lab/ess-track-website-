<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    protected $table = 'service_orders';

    public $timestamps = false;

    protected $fillable = [
        'customer_name',
        'email',
        'phone',
        'vehicle_no',
        'vehicle_type',
        'interested_package',
        'package_rate',
        'package_price',
        'residential_address',
        'commercial_address',
        'postal_code',
        'home_phone',
        'office_phone',
        'message',
        'raw_payload',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'raw_payload' => 'array',
    ];
}
