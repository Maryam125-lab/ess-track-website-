<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CmsRepository;
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

    public function store(Request $request, CmsRepository $cms)
    {
        $data = $this->validated($request);
        $data = $this->applyImageUpload($request, $data);
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

    public function update(Request $request, int $id, CmsRepository $cms)
    {
        $data = $this->validated($request);
        $data = $this->applyImageUpload($request, $data);

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
            'image_file' => 'nullable|image|max:4096',
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

    protected function applyImageUpload(Request $request, array $data): array
    {
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $fileName = time() . '_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $file->getClientOriginalName());
            $file->move(public_path('images/uploads'), $fileName);
            $data['image_url'] = 'images/uploads/' . $fileName;
        }

        return $data;
    }
}