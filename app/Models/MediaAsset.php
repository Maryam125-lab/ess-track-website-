<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaAsset extends Model
{
    protected $fillable = ['uuid', 'original_name', 'mime_type', 'size_bytes', 'content'];

    protected $hidden = ['content'];
}
