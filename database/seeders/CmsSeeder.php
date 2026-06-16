<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\ChatbotFaq;
use App\Models\CmsPageSeo;
use App\Models\CmsSiteSetting;
use App\Models\Promotion;
use App\Models\SuccessStory;
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
            unset($post['id']);

            BlogPost::updateOrCreate(
                ['slug' => $post['slug']],
                $post
            );
        }

        foreach ($defaults['success_stories'] as $story) {
            unset($story['id']);

            SuccessStory::updateOrCreate(
                ['slug' => $story['slug']],
                $story
            );
        }

        foreach ($defaults['promotions'] as $promotion) {
            unset($promotion['id']);

            Promotion::updateOrCreate(
                ['title' => $promotion['title']],
                $promotion
            );
        }

        foreach ($defaults['chatbot_faqs'] as $faq) {
            unset($faq['id']);

            ChatbotFaq::updateOrCreate(
                ['question' => $faq['question']],
                $faq
            );
        }
    }
}
