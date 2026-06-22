<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('portal_users')) {
            Schema::create('portal_users', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100)->default('Management User');
                $table->string('email', 190)->unique();
                $table->string('password_hash');
                $table->boolean('is_active')->default(true);
                $table->timestamp('last_login_at')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('media_assets')) {
            Schema::create('media_assets', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->unique();
                $table->string('original_name');
                $table->string('mime_type', 100);
                $table->unsignedBigInteger('size_bytes');
                $table->binary('content');
                $table->timestamps();
            });

            if (Schema::getConnection()->getDriverName() === 'mysql') {
                DB::statement('ALTER TABLE media_assets MODIFY content MEDIUMBLOB NOT NULL');
            }
        }

        $email = config('cms.portal_bootstrap_email');
        $password = config('cms.portal_bootstrap_password');

        if ($email && $password) {
            DB::table('portal_users')->updateOrInsert(['email' => strtolower($email)], [
                'name' => 'ESS-Track Management',
                'email' => strtolower($email),
                'password_hash' => Hash::make($password),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('media_assets');
        Schema::dropIfExists('portal_users');
    }
};
