<?php

namespace App\Providers;

use App\Services\AnalyticsService;
use App\Services\CmsRepository;
use App\Services\CmsStorage;
use App\Services\PromotionRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        CmsStorage::ensureJsonStore();

        View::composer('layouts.app', function ($view) {
            if (request()->is('admin', 'admin/*')) {
                return;
            }

            $promotions = app(PromotionRepository::class);
            $view->with('activePromotions', $promotions->activeFor('home'));
            $view->with('promoModalOffers', $promotions->activeFor('promo_modal'));
        });

        View::composer('*', function ($view) {
            if (request()->is('admin', 'admin/*')) {
                return;
            }

            $cms = app(CmsRepository::class);
            $settings = $cms->getSettings();
            $contact = $this->siteContact($settings);

            $routeName = request()->route()?->getName();
            $pageKey = in_array($routeName, ['home', 'about', 'services', 'tracker', 'contact'], true) ? $routeName : null;
            $globalContent = $cms->pageContent('global');
            $servicesContent = $cms->pageContent('services');
            $servicePackages = $this->decodeJsonList($servicesContent['packages_json'] ?? '[]');
            $serviceAddons = $this->decodeJsonList($servicesContent['addons_json'] ?? '[]');

            $view->with([
                'siteSettings' => $settings,
                'siteContact' => $contact,
                'siteSetting' => fn ($key, $default = '') => $settings[$key] ?? $default,
                'siteWhatsappLink' => $this->whatsappLink($contact['whatsapp_url'], $contact['whatsapp_message']),
                'pageContent' => $pageKey ? $cms->pageContent($pageKey) : [],
                'globalContent' => $globalContent,
                'globalText' => fn ($key, $default = '') => $globalContent[$key] ?? $default,
                'servicePackages' => $servicePackages,
                'serviceAddons' => $serviceAddons,
            ]);
        });

        if (! app()->runningInConsole() && request() && ! request()->is('admin', 'admin/*')) {
            try {
                app(AnalyticsService::class)->track(
                    request()->path(),
                    null,
                    request()->headers->get('referer')
                );
            } catch (\Throwable $e) {
                //
            }
        }
    }

    protected function decodeJsonList(string $value): array
    {
        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : [];
    }
    protected function siteContact(array $settings): array
    {
        $phone = $settings['phone'] ?? '021-34330887-88';
        $whatsapp = $settings['whatsapp'] ?? 'https://wa.me/923342011104';

        return [
            'company_name' => $settings['company_name'] ?? 'Electronic Safety & Security Pvt. Ltd.',
            'brand_name' => $settings['brand_name'] ?? 'ESS-TRACK',
            'phone' => $phone,
            'phone_href' => preg_replace('/[^0-9+]/', '', $phone) ?: $phone,
            'email' => $settings['email'] ?? 'info@esspl.com.pk',
            'address' => $settings['address'] ?? 'Suite 201, Kawish Crown, Block 6 PECHS, Karachi',
            'facebook' => $settings['facebook'] ?? 'https://www.facebook.com/ESSTRACKPAKISTAN',
            'whatsapp_url' => $this->normalizeWhatsappUrl($whatsapp),
            'whatsapp_message' => 'Hey, can I get more info about packages?',
            'default_og_image' => $settings['default_og_image'] ?? '/images/og-default.jpg',
        ];
    }

    protected function normalizeWhatsappUrl(string $value): string
    {
        if (preg_match('#^https?://#i', $value)) {
            return $value;
        }

        $number = preg_replace('/[^0-9+]/', '', $value) ?: '923342011104';
        return 'https://wa.me/' . $number;
    }

    protected function whatsappLink(string $url, string $message): string
    {
        $separator = strpos($url, '?') === false ? '?' : '&';
        return $url . $separator . 'text=' . urlencode($message);
    }
}