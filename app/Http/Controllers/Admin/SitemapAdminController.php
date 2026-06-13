<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CmsRepository;

class SitemapAdminController extends Controller
{
    public function index(CmsRepository $cms)
    {
        $base = rtrim(config('seo.site_url'), '/');
        $static = [
            ['url' => $base, 'label' => 'Home', 'priority' => '1.0'],
            ['url' => $base . '/about', 'label' => 'About', 'priority' => '0.8'],
            ['url' => $base . '/services', 'label' => 'Packages', 'priority' => '0.8'],
            ['url' => $base . '/tracker', 'label' => 'Vehicle Tracker', 'priority' => '0.8'],
            ['url' => $base . '/blog', 'label' => 'Blog', 'priority' => '0.7'],
            ['url' => $base . '/success-stories', 'label' => 'Success Stories', 'priority' => '0.7'],
            ['url' => $base . '/contact', 'label' => 'Contact', 'priority' => '0.8'],
        ];

        $blog = collect($cms->publishedBlogPosts())->map(fn ($p) => [
            'url' => $base . '/blog/' . $p['slug'],
            'label' => $p['title'],
            'priority' => '0.6',
        ])->all();

        return view('admin.sitemap.index', [
            'sitemapUrl' => $base . '/sitemap.xml',
            'pages' => array_merge($static, $blog),
        ]);
    }
}
