<?php

namespace App\Services;

use App\Models\BlogPost;
use App\Models\CmsPageContent;
use App\Models\CmsPageSeo;
use App\Models\CmsSiteSetting;
use App\Models\SuccessStory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CmsRepository
{
    public function __construct()
    {
        CmsStorage::ensureJsonStore();
    }

    /* ── Site Settings ── */

    public function getSettings(): array
    {
        if (CmsStorage::usesDatabase()) {
            return CmsSiteSetting::pluck('value', 'key')->toArray();
        }

        return CmsStorage::readJson()['site_settings'] ?? [];
    }

    public function saveSettings(array $data): void
    {
        if (CmsStorage::usesDatabase()) {
            foreach ($data as $key => $value) {
                CmsSiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
            }

            return;
        }

        $store = CmsStorage::readJson();
        $store['site_settings'] = array_merge($store['site_settings'] ?? [], $data);
        CmsStorage::writeJson($store);
    }

    public function pageContent(string $pageKey): array
    {
        if (CmsStorage::usesDatabase() && Schema::hasTable('cms_page_contents')) {
            return CmsPageContent::where('page_key', $pageKey)
                ->pluck('value', 'field_key')
                ->toArray();
        }

        return CmsStorage::readJson()['page_content'][$pageKey] ?? [];
    }

    public function savePageContent(string $pageKey, array $fields, array $data): void
    {
        if (CmsStorage::usesDatabase() && Schema::hasTable('cms_page_contents')) {
            $sort = 0;

            foreach ($fields as $group => $items) {
                foreach ($items as $label => [$fieldKey, $type, $default]) {
                    CmsPageContent::updateOrCreate(
                        ['page_key' => $pageKey, 'field_key' => $fieldKey],
                        [
                            'label' => $label,
                            'value' => $data[$fieldKey] ?? $default,
                            'type' => $type,
                            'group' => $group,
                            'sort_order' => $sort++,
                        ]
                    );
                }
            }

            return;
        }

        $store = CmsStorage::readJson();
        $store['page_content'][$pageKey] = array_merge($store['page_content'][$pageKey] ?? [], $data);
        CmsStorage::writeJson($store);
    }

    /* ── Page SEO ── */

    public function allPageSeo(): array
    {
        if (CmsStorage::usesDatabase()) {
            return CmsPageSeo::orderBy('page_key')->get()->toArray();
        }

        return CmsStorage::readJson()['page_seo'] ?? [];
    }

    public function savePageSeo(string $pageKey, array $data): void
    {
        $payload = array_merge(['page_key' => $pageKey], $data);

        if (CmsStorage::usesDatabase()) {
            CmsPageSeo::updateOrCreate(['page_key' => $pageKey], $data);

            return;
        }

        $store = CmsStorage::readJson();
        $pages = $store['page_seo'] ?? [];
        $found = false;

        foreach ($pages as $i => $page) {
            if (($page['page_key'] ?? '') === $pageKey) {
                $pages[$i] = array_merge($page, $payload);
                $found = true;
                break;
            }
        }

        if (! $found) {
            $pages[] = $payload;
        }

        $store['page_seo'] = $pages;
        CmsStorage::writeJson($store);
    }

    /* ── Blog ── */

    public function publishedBlogPosts(): array
    {
        if (CmsStorage::usesDatabase()) {
            return BlogPost::published()->get()->toArray();
        }

        return collect(CmsStorage::readJson()['blog_posts'] ?? [])
            ->filter(fn ($p) => ($p['status'] ?? '') === 'published')
            ->sortByDesc('published_at')
            ->values()
            ->all();
    }

    public function allBlogPosts(): array
    {
        if (CmsStorage::usesDatabase()) {
            return BlogPost::orderByDesc('created_at')->get()->toArray();
        }

        return CmsStorage::readJson()['blog_posts'] ?? [];
    }

    public function findBlogPost(string $slug): ?array
    {
        if (CmsStorage::usesDatabase()) {
            $post = BlogPost::where('slug', $slug)->where('status', 'published')->first();

            return $post ? $post->toArray() : null;
        }

        foreach (CmsStorage::readJson()['blog_posts'] ?? [] as $post) {
            if ($post['slug'] === $slug && ($post['status'] ?? '') === 'published') {
                return $post;
            }
        }

        return null;
    }

    public function findBlogPostById(int $id): ?array
    {
        if (CmsStorage::usesDatabase()) {
            $post = BlogPost::find($id);

            return $post ? $post->toArray() : null;
        }

        foreach (CmsStorage::readJson()['blog_posts'] ?? [] as $post) {
            if ((int) ($post['id'] ?? 0) === $id) {
                return $post;
            }
        }

        return null;
    }

    public function saveBlogPost(array $data, ?int $id = null): array
    {
        if (CmsStorage::usesDatabase()) {
            if ($id) {
                $post = BlogPost::findOrFail($id);
                $post->update($data);

                return $post->fresh()->toArray();
            }

            return BlogPost::create($data)->toArray();
        }

        $store = CmsStorage::readJson();
        $posts = $store['blog_posts'] ?? [];

        if ($id) {
            foreach ($posts as $i => $post) {
                if ((int) ($post['id'] ?? 0) === $id) {
                    $posts[$i] = array_merge($post, $data, ['id' => $id]);
                    $store['blog_posts'] = $posts;
                    CmsStorage::writeJson($store);

                    return $posts[$i];
                }
            }
        }

        $newId = collect($posts)->max('id') + 1;
        $new = array_merge($data, ['id' => $newId ?: 1]);
        $posts[] = $new;
        $store['blog_posts'] = $posts;
        CmsStorage::writeJson($store);

        return $new;
    }

    public function deleteBlogPost(int $id): void
    {
        if (CmsStorage::usesDatabase()) {
            BlogPost::destroy($id);

            return;
        }

        $store = CmsStorage::readJson();
        $store['blog_posts'] = array_values(array_filter(
            $store['blog_posts'] ?? [],
            fn ($p) => (int) ($p['id'] ?? 0) !== $id
        ));
        CmsStorage::writeJson($store);
    }

    /* ── Success Stories ── */

    public function publishedSuccessStories(): array
    {
        if (CmsStorage::usesDatabase()) {
            return SuccessStory::published()->get()->toArray();
        }

        return collect(CmsStorage::readJson()['success_stories'] ?? [])
            ->filter(fn ($s) => ($s['status'] ?? '') === 'published')
            ->sortBy('sort_order')
            ->values()
            ->all();
    }

    public function allSuccessStories(): array
    {
        if (CmsStorage::usesDatabase()) {
            return SuccessStory::orderBy('sort_order')->get()->toArray();
        }

        return CmsStorage::readJson()['success_stories'] ?? [];
    }

    public function findSuccessStoryById(int $id): ?array
    {
        if (CmsStorage::usesDatabase()) {
            $story = SuccessStory::find($id);

            return $story ? $story->toArray() : null;
        }

        foreach (CmsStorage::readJson()['success_stories'] ?? [] as $story) {
            if ((int) ($story['id'] ?? 0) === $id) {
                return $story;
            }
        }

        return null;
    }

    public function saveSuccessStory(array $data, ?int $id = null): array
    {
        if (CmsStorage::usesDatabase()) {
            if ($id) {
                $story = SuccessStory::findOrFail($id);
                $story->update($data);

                return $story->fresh()->toArray();
            }

            return SuccessStory::create($data)->toArray();
        }

        $store = CmsStorage::readJson();
        $stories = $store['success_stories'] ?? [];

        if ($id) {
            foreach ($stories as $i => $story) {
                if ((int) ($story['id'] ?? 0) === $id) {
                    $stories[$i] = array_merge($story, $data, ['id' => $id]);
                    $store['success_stories'] = $stories;
                    CmsStorage::writeJson($store);

                    return $stories[$i];
                }
            }
        }

        $newId = collect($stories)->max('id') + 1;
        $new = array_merge($data, ['id' => $newId ?: 1]);
        $stories[] = $new;
        $store['success_stories'] = $stories;
        CmsStorage::writeJson($store);

        return $new;
    }

    public function deleteSuccessStory(int $id): void
    {
        if (CmsStorage::usesDatabase()) {
            SuccessStory::destroy($id);

            return;
        }

        $store = CmsStorage::readJson();
        $store['success_stories'] = array_values(array_filter(
            $store['success_stories'] ?? [],
            fn ($s) => (int) ($s['id'] ?? 0) !== $id
        ));
        CmsStorage::writeJson($store);
    }

    public function storageMode(): string
    {
        return CmsStorage::usesDatabase() ? 'database' : 'json';
    }

    public function uniqueBlogSlug(string $title, ?int $ignoreId = null): string
    {
        if (CmsStorage::usesDatabase()) {
            return \App\Models\BlogPost::uniqueSlug($title, $ignoreId);
        }

        return $this->uniqueSlugFromList($title, collect($this->allBlogPosts()), $ignoreId);
    }

    public function uniqueStorySlug(string $title, ?int $ignoreId = null): string
    {
        if (CmsStorage::usesDatabase()) {
            return \App\Models\SuccessStory::uniqueSlug($title, $ignoreId);
        }

        return $this->uniqueSlugFromList($title, collect($this->allSuccessStories()), $ignoreId);
    }

    protected function uniqueSlugFromList(string $title, $items, ?int $ignoreId): string
    {
        $slug = Str::slug($title);
        $base = $slug;
        $i = 1;

        while ($items->contains(fn ($item) => ($item['slug'] ?? '') === $slug && (int) ($item['id'] ?? 0) !== (int) $ignoreId)) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
