<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $table = 'inquiries';

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
