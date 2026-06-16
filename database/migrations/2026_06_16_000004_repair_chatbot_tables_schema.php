<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasTable('chatbot_faqs')) {
            Schema::table('chatbot_faqs', function (Blueprint $table) {
                if (! Schema::hasColumn('chatbot_faqs', 'question')) {
                    $table->string('question', 500)->nullable()->after('id');
                }
                if (! Schema::hasColumn('chatbot_faqs', 'answer')) {
                    $table->text('answer')->nullable()->after('question');
                }
                if (! Schema::hasColumn('chatbot_faqs', 'keywords')) {
                    $table->string('keywords', 500)->nullable()->after('answer');
                }
                if (! Schema::hasColumn('chatbot_faqs', 'status')) {
                    $table->string('status', 20)->default('active')->after('keywords');
                }
                if (! Schema::hasColumn('chatbot_faqs', 'sort_order')) {
                    $table->unsignedInteger('sort_order')->default(0)->after('status');
                }
            });
        }

        if (Schema::hasTable('chatbot_logs')) {
            if (Schema::hasColumn('chatbot_logs', 'session_id')) {
                DB::statement('ALTER TABLE chatbot_logs MODIFY session_id VARCHAR(255) NULL');
            }

            Schema::table('chatbot_logs', function (Blueprint $table) {
                if (! Schema::hasColumn('chatbot_logs', 'user_message')) {
                    $table->text('user_message')->nullable()->after('id');
                }
                if (! Schema::hasColumn('chatbot_logs', 'bot_reply')) {
                    $table->text('bot_reply')->nullable()->after('user_message');
                }
                if (! Schema::hasColumn('chatbot_logs', 'source')) {
                    $table->string('source', 30)->default('faq')->after('bot_reply');
                }
                if (! Schema::hasColumn('chatbot_logs', 'lead_name')) {
                    $table->string('lead_name')->nullable()->after('source');
                }
                if (! Schema::hasColumn('chatbot_logs', 'lead_email')) {
                    $table->string('lead_email')->nullable()->after('lead_name');
                }
                if (! Schema::hasColumn('chatbot_logs', 'lead_phone')) {
                    $table->string('lead_phone', 30)->nullable()->after('lead_email');
                }
                if (! Schema::hasColumn('chatbot_logs', 'package_interest')) {
                    $table->string('package_interest', 100)->nullable()->after('lead_phone');
                }
            });
        }
    }

    public function down()
    {
        // Keep repaired columns/data; this migration is intentionally non-destructive.
    }
};
