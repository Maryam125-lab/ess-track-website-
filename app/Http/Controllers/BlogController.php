<?php

namespace App\Http\Controllers;

use App\Services\CmsRepository;
use App\Services\SeoService;

class BlogController extends Controller
{
    public function index(CmsRepository $cms, SeoService $seo)
    {
        return view('blog.index', [
            'posts' => $cms->publishedBlogPosts(),
            'seo' => $seo->forPage('blog'),
            'schemas' => [$seo->organizationSchema()],
        ]);
    }

    public function show(string $slug, CmsRepository $cms, SeoService $seo)
    {
        $post = $cms->findBlogPost($slug);

        if (! $post) {
            abort(404);
        }

        return view('blog.show', [
            'post' => $post,
            'seo' => $seo->forPage('blog', [
                'meta_title' => $post['meta_title'] ?? $post['title'] . ' — ESS-Track Blog',
                'meta_description' => $post['meta_description'] ?? $post['excerpt'] ?? '',
                'og_title' => $post['title'],
                'og_description' => $post['excerpt'] ?? '',
                'og_image' => $post['image_url'] ?? null,
                'canonical' => rtrim(config('seo.site_url'), '/') . '/blog/' . $slug,
            ]),
            'articleSchema' => $seo->articleSchema($post),
        ]);
    }
}
