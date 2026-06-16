<?php

return [

  'admin_email' => env('CMS_PORTAL_EMAIL', env('CMS_ADMIN_EMAIL', 'portal@esspl.com.pk')),

  'admin_password' => env('CMS_ADMIN_PASSWORD', 'ESSTrack@2026'),

    'json_store' => storage_path('app/cms/store.json'),

    'use_json_storage' => env('CMS_USE_JSON', env('APP_ENV', 'production') === 'local'),

];
