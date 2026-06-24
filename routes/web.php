<?php



use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;

use App\Http\Controllers\BlogController;

use App\Http\Controllers\SuccessStoriesController;

use App\Http\Controllers\SitemapController;

use App\Http\Controllers\ChatController;
use App\Http\Controllers\PublicApiController;
use App\Http\Controllers\MediaController;
use App\Http\Middleware\VerifyCsrfToken;

use App\Http\Controllers\Admin\AuthController;

use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\BlogController as AdminBlogController;

use App\Http\Controllers\Admin\SuccessStoryController;

use App\Http\Controllers\Admin\SeoController;

use App\Http\Controllers\Admin\SettingsController;

use App\Http\Controllers\Admin\OrderController;

use App\Http\Controllers\Admin\InquiryController;

use App\Http\Controllers\Admin\PromotionController;

use App\Http\Controllers\Admin\AnalyticsController;

use App\Http\Controllers\Admin\ChatFaqController;

use App\Http\Controllers\Admin\SitemapAdminController;
use App\Http\Controllers\Admin\PageContentController;

use App\Services\SeoService;
use App\Services\PromotionRepository;



Route::get('/', function (SeoService $seo) {

    return view('home', [

        'seo' => $seo->forPage('home'),

        'schemas' => [$seo->organizationSchema(), $seo->websiteSchema(), $seo->serviceSchema()],

    ]);

})->name('home');



Route::get('/about', function (SeoService $seo) {

    return view('about', ['seo' => $seo->forPage('about'), 'schemas' => [$seo->organizationSchema()]]);

})->name('about');



Route::get('/services', function (SeoService $seo, PromotionRepository $promotions) {
    $servicePromotions = $promotions->activeFor('services');

    return view('services', [
        'seo' => $seo->forPage('services'),
        'schemas' => [$seo->organizationSchema(), $seo->serviceSchema()],
        'servicePromotions' => $servicePromotions,
        'packageDiscounts' => [
            'silver' => $promotions->forPackage('silver', $servicePromotions),
            'gold' => $promotions->forPackage('gold', $servicePromotions),
            'platinum' => $promotions->forPackage('platinum', $servicePromotions),
            'fleet' => $promotions->forPackage('fleet', $servicePromotions),
        ],
    ]);
})->name('services');



Route::get('/tracker', function (SeoService $seo) {

    return view('tracker', ['seo' => $seo->forPage('tracker'), 'schemas' => [$seo->organizationSchema()]]);

})->name('tracker');



Route::get('/contact', function (SeoService $seo) {

    return view('contact', ['seo' => $seo->forPage('contact'), 'schemas' => [$seo->organizationSchema()]]);

})->name('contact');



Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::post('/chat', [ChatController::class, 'message'])->middleware('throttle:chat')->name('chat.message');

foreach (['api', 'public-api'] as $apiPrefix) {
    Route::prefix($apiPrefix)
        ->withoutMiddleware([VerifyCsrfToken::class])
        ->group(function () {
            Route::options('/{path?}', fn () => response('', 204))->where('path', '.*');
            Route::post('/send-otp', [PublicApiController::class, 'sendOtp'])->middleware('throttle:otp');
            Route::post('/verify-otp', [PublicApiController::class, 'verifyOtp'])->middleware('throttle:otp');
            Route::post('/inquiries', [PublicApiController::class, 'storeInquiry'])->middleware('throttle:inquiries');
        });
}



Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');

Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/success-stories', [SuccessStoriesController::class, 'index'])->name('success-stories.index');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/media/{uuid}', [MediaController::class, 'show'])
    ->whereUuid('uuid')
    ->name('media.show');



Route::redirect('/admin', '/portal');
Route::redirect('/admin/login', '/portal/login');
Route::get('/admin/{path}', function (string $path) {
    return redirect('/portal/' . ltrim($path, '/'));
})->where('path', '.*');

Route::prefix('portal')->name('admin.')->group(function () {

    Route::get('/', [AuthController::class, 'showLogin'])->name('entry');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:portal-login')->name('login.submit');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



    Route::middleware('admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/password', [AuthController::class, 'showPasswordForm'])->name('password.edit');

        Route::post('/password', [AuthController::class, 'updatePassword'])->name('password.update');



        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');



        Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');

        Route::get('/inquiries/{id}', [InquiryController::class, 'show'])->name('inquiries.show');



        Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');

        Route::get('/promotions/create', [PromotionController::class, 'create'])->name('promotions.create');

        Route::post('/promotions', [PromotionController::class, 'store'])->name('promotions.store');

        Route::get('/promotions/{id}/edit', [PromotionController::class, 'edit'])->name('promotions.edit');

        Route::put('/promotions/{id}', [PromotionController::class, 'update'])->name('promotions.update');

        Route::delete('/promotions/{id}', [PromotionController::class, 'destroy'])->name('promotions.destroy');



        Route::get('/blog', [AdminBlogController::class, 'index'])->name('blog.index');

        Route::get('/blog/create', [AdminBlogController::class, 'create'])->name('blog.create');

        Route::post('/blog', [AdminBlogController::class, 'store'])->name('blog.store');

        Route::get('/blog/{id}/edit', [AdminBlogController::class, 'edit'])->name('blog.edit');

        Route::put('/blog/{id}', [AdminBlogController::class, 'update'])->name('blog.update');

        Route::delete('/blog/{id}', [AdminBlogController::class, 'destroy'])->name('blog.destroy');



        Route::get('/success-stories', [SuccessStoryController::class, 'index'])->name('success-stories.index');

        Route::get('/success-stories/create', [SuccessStoryController::class, 'create'])->name('success-stories.create');

        Route::post('/success-stories', [SuccessStoryController::class, 'store'])->name('success-stories.store');

        Route::get('/success-stories/{id}/edit', [SuccessStoryController::class, 'edit'])->name('success-stories.edit');

        Route::put('/success-stories/{id}', [SuccessStoryController::class, 'update'])->name('success-stories.update');

        Route::get('/success-stories/{id}/delete', [SuccessStoryController::class, 'destroy'])->name('success-stories.delete');

        Route::delete('/success-stories/{id}', [SuccessStoryController::class, 'destroy'])->name('success-stories.destroy');



        Route::get('/chatbot', [ChatFaqController::class, 'index'])->name('chatbot.index');

        Route::get('/chatbot/create', [ChatFaqController::class, 'create'])->name('chatbot.create');

        Route::post('/chatbot', [ChatFaqController::class, 'store'])->name('chatbot.store');

        Route::get('/chatbot/{id}/edit', [ChatFaqController::class, 'edit'])->name('chatbot.edit');

        Route::put('/chatbot/{id}', [ChatFaqController::class, 'update'])->name('chatbot.update');

        Route::delete('/chatbot/{id}', [ChatFaqController::class, 'destroy'])->name('chatbot.destroy');



        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

        Route::get('/sitemap', [SitemapAdminController::class, 'index'])->name('sitemap.index');

        Route::get('/pages', [PageContentController::class, 'index'])->name('pages.index');

        Route::get('/pages/{pageKey}', [PageContentController::class, 'edit'])->name('pages.edit');

        Route::post('/pages/{pageKey}', [PageContentController::class, 'update'])->name('pages.update');



        Route::get('/seo', [SeoController::class, 'index'])->name('seo.index');

        Route::post('/seo', [SeoController::class, 'update'])->name('seo.update');



        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

        Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

    });

});


