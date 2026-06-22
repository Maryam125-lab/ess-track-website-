<?php

return [
    'driver' => env('MEDIA_STORAGE_DRIVER', 'database'),
    'max_upload_kb' => (int) env('MEDIA_MAX_UPLOAD_KB', 4096),
    'cloudinary' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET'),
    ],
];
