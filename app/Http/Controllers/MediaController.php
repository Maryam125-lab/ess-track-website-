<?php

namespace App\Http\Controllers;

use App\Models\MediaAsset;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function show(Request $request, string $uuid)
    {
        $asset = MediaAsset::where('uuid', $uuid)->firstOrFail();
        $etag = '"' . hash('sha256', $asset->content) . '"';

        if ($request->headers->get('If-None-Match') === $etag) {
            return response('', 304)->header('ETag', $etag);
        }

        return response($asset->content, 200, [
            'Content-Type' => $asset->mime_type,
            'Content-Length' => (string) $asset->size_bytes,
            'Content-Disposition' => 'inline; filename="' . addslashes($asset->original_name) . '"',
            'Cache-Control' => 'public, max-age=31536000, immutable',
            'ETag' => $etag,
        ]);
    }
}
