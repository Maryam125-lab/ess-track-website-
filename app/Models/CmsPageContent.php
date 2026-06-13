<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsPageContent extends Model
{
    protected $fillable = [
        'page_key',
        'field_key',
        'label',
        'value',
        'type',
        'group',
        'sort_order',
    ];
}
