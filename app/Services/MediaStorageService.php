<?php

namespace App\Services;

use App\Models\MediaAsset;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RuntimeException;

class MediaStorageService
{
    public function store(UploadedFile $file): string
    {
        if (config('media.driver') === 'cloudinary') {
            return $this->storeOnCloudinary($file);
        }

        $uuid = (string) Str::uuid();
        MediaAsset::create([
            'uuid' => $uuid,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType() ?: 'application/octet-stream',
            'size_bytes' => $file->getSize() ?: 0,
            'content' => file_get_contents($file->getRealPath()),
        ]);

        return '/media/' . $uuid;
    }

    private function storeOnCloudinary(UploadedFile $file): string
    {
        $cloud = config('media.cloudinary.cloud_name');
        $preset = config('media.cloudinary.upload_preset');

        if (! $cloud || ! $preset) {
            throw new RuntimeException('Cloudinary is selected but its cloud name or upload preset is missing.');
        }

        $response = Http::timeout(30)
            ->attach('file', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
            ->post("https://api.cloudinary.com/v1_1/{$cloud}/auto/upload", [
                'upload_preset' => $preset,
                'folder' => 'ess-track',
            ]);

        if (! $response->successful() || ! $response->json('secure_url')) {
            throw new RuntimeException('Cloud media upload failed. Please try again.');
        }

        return $response->json('secure_url');
    }
}
