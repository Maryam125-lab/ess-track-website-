<?php
$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);
// Vercel read-only filesystem fix
@mkdir('/tmp/storage/framework/views', 0777, true);
@mkdir('/tmp/storage/framework/cache', 0777, true);
@mkdir('/tmp/storage/framework/sessions', 0777, true);
@mkdir('/tmp/bootstrap/cache', 0777, true);
$app->useStoragePath('/tmp/storage');
$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);
$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);
return $app;