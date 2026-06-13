<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsPageSeo extends Model
{
    protected $table = 'cms_page_seo';

    protected $fillable = [
        'page_key', 'meta_title', 'meta_description',
        'og_title', 'og_description', 'og_image', 'keywords',
    ];
}
