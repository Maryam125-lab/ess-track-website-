<?php

namespace App\Http\Controllers;

use App\Services\CmsRepository;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(CmsRepository $cms): Response
    {
        $base = rtrim(config('seo.site_url'), '/');
        $static = ['', '/about', '/services', '/tracker', '/contact', '/blog', '/success-stories'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($static as $path) {
            $xml .= $this->url($base . $path, 'weekly', $path === '' ? '1.0' : '0.8');
        }

        foreach ($cms->publishedBlogPosts() as $post) {
            $xml .= $this->url($base . '/blog/' . $post['slug'], 'monthly', '0.7', $post['updated_at'] ?? $post['published_at'] ?? null);
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    protected function url(string $loc, string $freq, string $priority, $lastmod = null): string
    {
        $xml = '<url><loc>' . htmlspecialchars($loc) . '</loc>';
        $xml .= '<changefreq>' . $freq . '</changefreq>';
        $xml .= '<priority>' . $priority . '</priority>';

        if ($lastmod) {
            $xml .= '<lastmod>' . date('Y-m-d', strtotime($lastmod)) . '</lastmod>';
        }

        $xml .= '</url>';

        return $xml;
    }
}
