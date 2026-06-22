<?php

namespace Tests\Feature;

use App\Services\MediaStorageService;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PersistentMediaTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('media_assets', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('original_name');
            $table->string('mime_type');
            $table->unsignedBigInteger('size_bytes');
            $table->binary('content');
            $table->timestamps();
        });
    }

    public function test_uploaded_media_is_persisted_and_served(): void
    {
        config(['media.driver' => 'database']);
        $contents = "fake-image-contents";
        $file = UploadedFile::fake()->createWithContent('tracker.webp', $contents);

        $url = app(MediaStorageService::class)->store($file);

        $this->assertMatchesRegularExpression('#^/media/[0-9a-f-]{36}$#', $url);
        $response = $this->get($url)->assertOk()->assertSee($contents, false);
        $cacheControl = $response->headers->get('Cache-Control');

        $this->assertStringContainsString('public', $cacheControl);
        $this->assertStringContainsString('max-age=31536000', $cacheControl);
        $this->assertStringContainsString('immutable', $cacheControl);
    }
}
