<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CmsRepository;
use App\Services\MediaStorageService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(CmsRepository $cms)
    {
        return view('admin.blog.index', ['posts' => $cms->allBlogPosts()]);
    }

    public function create()
    {
        return view('admin.blog.form', ['post' => null]);
    }

    public function store(Request $request, CmsRepository $cms, MediaStorageService $media)
    {
        $data = $this->validated($request);
        $data = $this->applyImageUpload($request, $data, $media);
        $data['slug'] = $cms->uniqueBlogSlug($data['title']);
        $cms->saveBlogPost($data);

        return redirect()->route('admin.blog.index')->with('success', 'Blog post created.');
    }

    public function edit(int $id, CmsRepository $cms)
    {
        $post = $cms->findBlogPostById($id);

        if (! $post) {
            abort(404);
        }

        return view('admin.blog.form', ['post' => $post]);
    }

    public function update(Request $request, int $id, CmsRepository $cms, MediaStorageService $media)
    {
        $data = $this->validated($request);
        $data = $this->applyImageUpload($request, $data, $media);

        if ($request->boolean('regenerate_slug')) {
            $data['slug'] = $cms->uniqueBlogSlug($data['title'], $id);
        }

        $cms->saveBlogPost($data, $id);

        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated.');
    }

    public function destroy(int $id, CmsRepository $cms)
    {
        $cms->deleteBlogPost($id);

        return redirect()->route('admin.blog.index')->with('success', 'Blog post deleted.');
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image_url' => 'nullable|string|max:500',
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:' . config('media.max_upload_kb')],
            'author' => 'required|string|max:100',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'published_at' => 'nullable|date',
        ]);

        if (empty($data['published_at']) && $data['status'] === 'published') {
            $data['published_at'] = now()->format('Y-m-d H:i:s');
        }

        unset($data['image_file']);

        return $data;
    }

    protected function applyImageUpload(Request $request, array $data, MediaStorageService $media): array
    {
        if ($request->hasFile('image_file')) {
            $data['image_url'] = $media->store($request->file('image_file'));
        }

        return $data;
    }
}
