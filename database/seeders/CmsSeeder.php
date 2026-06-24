<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\CmsPageSeo;
use App\Models\CmsSiteSetting;
use App\Services\CmsStorage;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    public function run()
    {
        $defaults = CmsStorage::defaultStore();

        foreach ($defaults['site_settings'] as $key => $value) {
            CmsSiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        foreach ($defaults['page_seo'] as $page) {
            $key = $page['page_key'];
            unset($page['page_key']);
            CmsPageSeo::updateOrCreate(['page_key' => $key], $page);
        }

        foreach ($defaults['blog_posts'] as $post) {
            BlogPost::updateOrCreate(
                ['slug' => $post['slug']],
                $post
            );
        }
    }
}
