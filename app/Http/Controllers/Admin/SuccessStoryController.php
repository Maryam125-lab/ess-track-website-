<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CmsRepository;
use Illuminate\Http\Request;

class SuccessStoryController extends Controller
{
    public function index(CmsRepository $cms)
    {
        return view('admin.success-stories.index', ['stories' => $cms->allSuccessStories()]);
    }

    public function create()
    {
        return view('admin.success-stories.form', ['story' => null]);
    }

    public function store(Request $request, CmsRepository $cms)
    {
        $data = $this->validated($request);
        $data = $this->applyImageUpload($request, $data);
        $data['status'] = $data['status'] ?? 'published';
        $data['slug'] = $cms->uniqueStorySlug($data['title']);
        $cms->saveSuccessStory($data);

        return redirect()->route('admin.success-stories.index')->with('success', 'Success story created.');
    }

    public function edit(int $id, CmsRepository $cms)
    {
        $story = $cms->findSuccessStoryById($id);

        if (! $story) {
            abort(404);
        }

        return view('admin.success-stories.form', ['story' => $story]);
    }

    public function update(Request $request, int $id, CmsRepository $cms)
    {
        $data = $this->validated($request);
        $data = $this->applyImageUpload($request, $data);

        if ($request->boolean('regenerate_slug')) {
            $data['slug'] = $cms->uniqueStorySlug($data['title'], $id);
        }

        $cms->saveSuccessStory($data, $id);

        return redirect()->route('admin.success-stories.index')->with('success', 'Success story updated.');
    }

    public function destroy(int $id, CmsRepository $cms)
    {
        $cms->deleteSuccessStory($id);

        return redirect()->route('admin.success-stories.index')->with('success', 'Success story deleted.');
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'image_url' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|max:4096',
            'client_name' => 'nullable|string|max:150',
            'industry' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

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