<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CmsRepository;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index(CmsRepository $cms)
    {
        $pages = config('seo.pages', []);
        $saved = collect($cms->allPageSeo())->keyBy('page_key');

        return view('admin.seo.index', compact('pages', 'saved'));
    }

    public function update(Request $request, CmsRepository $cms)
    {
        $pageKey = $request->input('page_key');

        if (! array_key_exists($pageKey, config('seo.pages', []))) {
            abort(404);
        }

        $data = $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'og_image' => 'nullable|string|max:500',
            'keywords' => 'nullable|string|max:500',
        ]);

        $data = array_map(fn ($value) => is_string($value) ? $this->cleanText($value) : $value, $data);

        $cms->savePageSeo($pageKey, $data);

        return back()->with('success', 'SEO updated for ' . ucfirst(str_replace('-', ' ', $pageKey)) . '.');
    }

    protected function cleanText(string $value): string
    {
        return trim(str_replace(['â€”', 'â€“', 'â€"', 'â€', 'Â·', 'Â', '—', '–'], ['-', '-', '-', '', '-', '', '-', '-'], $value));
    }
}
