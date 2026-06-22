<?php

return [

    'portal_bootstrap_email' => env('CMS_PORTAL_EMAIL', 'portal@esspl.com.pk'),

    'portal_bootstrap_password' => env('CMS_PORTAL_PASSWORD', env('CMS_ADMIN_PASSWORD')),

    'json_store' => storage_path('app/cms/store.json'),

    'use_json_storage' => env('CMS_USE_JSON', env('APP_ENV', 'production') === 'local'),

    'database_schema_ready' => env('CMS_DATABASE_SCHEMA_READY', env('APP_ENV') === 'production'),

];
