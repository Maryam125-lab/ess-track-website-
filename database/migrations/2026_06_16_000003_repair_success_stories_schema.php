<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('success_stories')) {
            return;
        }

        Schema::table('success_stories', function (Blueprint $table) {
            if (! Schema::hasColumn('success_stories', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('id');
            }
            if (! Schema::hasColumn('success_stories', 'excerpt')) {
                $table->text('excerpt')->nullable()->after('title');
            }
            if (! Schema::hasColumn('success_stories', 'content')) {
                $table->longText('content')->nullable()->after('excerpt');
            }
            if (! Schema::hasColumn('success_stories', 'image_url')) {
                $table->string('image_url')->nullable()->after('content');
            }
            if (! Schema::hasColumn('success_stories', 'client_name')) {
                $table->string('client_name')->nullable()->after('image_url');
            }
            if (! Schema::hasColumn('success_stories', 'industry')) {
                $table->string('industry')->nullable()->after('client_name');
            }
            if (! Schema::hasColumn('success_stories', 'status')) {
                $table->string('status')->default('published')->after('industry');
            }
            if (! Schema::hasColumn('success_stories', 'sort_order')) {
                $table->unsignedInteger('sort_order')->default(0)->after('status');
            }
            if (! Schema::hasColumn('success_stories', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('sort_order');
            }
            if (! Schema::hasColumn('success_stories', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
        });

        if (Schema::hasColumn('success_stories', 'details')) {
            DB::statement('ALTER TABLE success_stories MODIFY details LONGTEXT NULL');
        }

        $stories = DB::table('success_stories')->get();
        $usedSlugs = [];

        foreach ($stories as $story) {
            $base = Str::slug($story->slug ?: $story->title ?: 'success-story');
            $slug = $base ?: 'success-story';
            $i = 1;

            while (in_array($slug, $usedSlugs, true)) {
                $slug = $base . '-' . $i++;
            }

            $usedSlugs[] = $slug;

            DB::table('success_stories')->where('id', $story->id)->update([
                'slug' => $slug,
                'excerpt' => $story->excerpt ?? $story->summary ?? null,
                'content' => $story->content ?? $story->details ?? null,
                'image_url' => $story->image_url ?? $story->image ?? null,
                'status' => $story->status ?? 'published',
                'sort_order' => $story->sort_order ?? 0,
            ]);
        }
    }

    public function down()
    {
        // Keep repaired columns/data; this migration is intentionally non-destructive.
    }
};
