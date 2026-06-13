<?php

namespace App\Http\Controllers;

use App\Services\CmsRepository;
use App\Services\SeoService;

class SuccessStoriesController extends Controller
{
    public function index(CmsRepository $cms, SeoService $seo)
    {
        return view('success-stories.index', [
            'stories' => $cms->publishedSuccessStories(),
            'seo' => $seo->forPage('success-stories'),
        ]);
    }
}
