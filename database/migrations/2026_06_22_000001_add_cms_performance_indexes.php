<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_orders', function (Blueprint $table) {
            $table->index('created_at', 'service_orders_created_at_index');
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->index(['status', 'published_at'], 'blog_posts_status_published_at_index');
        });

        Schema::table('success_stories', function (Blueprint $table) {
            $table->index(['status', 'sort_order'], 'success_stories_status_sort_order_index');
        });

        Schema::table('promotions', function (Blueprint $table) {
            $table->index(['status', 'sort_order'], 'promotions_status_sort_order_index');
        });
    }

    public function down(): void
    {
        Schema::table('service_orders', function (Blueprint $table) {
            $table->dropIndex('service_orders_created_at_index');
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropIndex('blog_posts_status_published_at_index');
        });

        Schema::table('success_stories', function (Blueprint $table) {
            $table->dropIndex('success_stories_status_sort_order_index');
        });

        Schema::table('promotions', function (Blueprint $table) {
            $table->dropIndex('promotions_status_sort_order_index');
        });
    }
};
