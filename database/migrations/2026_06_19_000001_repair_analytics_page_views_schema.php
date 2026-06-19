<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $hasCurrentSchema = Schema::hasTable('analytics_page_views')
            && Schema::hasColumn('analytics_page_views', 'page_path')
            && Schema::hasColumn('analytics_page_views', 'viewed_at');

        if ($hasCurrentSchema) {
            return;
        }

        if (Schema::hasTable('analytics_page_views')) {
            if (! Schema::hasTable('analytics_page_views_legacy')) {
                Schema::rename('analytics_page_views', 'analytics_page_views_legacy');
            } else {
                Schema::drop('analytics_page_views');
            }
        }

        Schema::create('analytics_page_views', function (Blueprint $table) {
            $table->id();
            $table->string('page_path');
            $table->string('page_title')->nullable();
            $table->string('referrer', 500)->nullable();
            $table->timestamp('viewed_at')->useCurrent();
            $table->index('page_path');
            $table->index('viewed_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('analytics_page_views');

        if (Schema::hasTable('analytics_page_views_legacy')) {
            Schema::rename('analytics_page_views_legacy', 'analytics_page_views');
        }
    }
};
