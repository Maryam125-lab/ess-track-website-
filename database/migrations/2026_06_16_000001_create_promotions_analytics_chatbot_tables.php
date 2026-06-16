<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('promotions')) {
            Schema::create('promotions', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('promo_code', 50)->nullable();
                $table->string('discount_type', 30)->default('percent');
                $table->string('discount_value', 50)->nullable();
                $table->string('badge_text', 100)->nullable();
                $table->string('applies_to', 50)->default('all');
                $table->boolean('show_on_home')->default(true);
                $table->boolean('show_on_services')->default(true);
                $table->boolean('show_on_promo_modal')->default(true);
                $table->date('valid_from')->nullable();
                $table->date('valid_until')->nullable();
                $table->string('status', 20)->default('active');
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('analytics_page_views')) {
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

        if (! Schema::hasTable('chatbot_faqs')) {
            Schema::create('chatbot_faqs', function (Blueprint $table) {
                $table->id();
                $table->string('question', 500);
                $table->text('answer');
                $table->string('keywords', 500)->nullable();
                $table->string('status', 20)->default('active');
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('chatbot_logs')) {
            Schema::create('chatbot_logs', function (Blueprint $table) {
                $table->id();
                $table->text('user_message');
                $table->text('bot_reply');
                $table->string('source', 30)->default('faq');
                $table->string('lead_name')->nullable();
                $table->string('lead_email')->nullable();
                $table->string('lead_phone', 30)->nullable();
                $table->string('package_interest', 100)->nullable();
                $table->timestamp('created_at')->useCurrent();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('chatbot_logs');
        Schema::dropIfExists('chatbot_faqs');
        Schema::dropIfExists('analytics_page_views');
        Schema::dropIfExists('promotions');
    }
};
