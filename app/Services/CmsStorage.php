<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CmsStorage
{
    private static ?bool $dbAvailable = null;

    private static ?array $jsonCache = null;

    public static function usesDatabase(): bool
    {
        if (self::$dbAvailable !== null) {
            return self::$dbAvailable;
        }

        if (config('cms.use_json_storage', false)) {
            return self::$dbAvailable = false;
        }

        try {
            DB::connection()->getPdo();
            self::$dbAvailable = Schema::hasTable('cms_site_settings');
        } catch (\Throwable $e) {
            self::$dbAvailable = false;
        }

        return self::$dbAvailable;
    }

    public static function jsonPath(): string
    {
        return config('cms.json_store');
    }

    public static function readJson(): array
    {
        if (self::$jsonCache !== null) {
            return self::$jsonCache;
        }

        $path = self::jsonPath();

        if (! file_exists($path)) {
            return self::$jsonCache = self::defaultStore();
        }

        $contents = file_get_contents($path);
        $contents = preg_replace('/^\xEF\xBB\xBF/', '', $contents);
        $data = json_decode($contents, true);

        return self::$jsonCache = (is_array($data) ? $data : self::defaultStore());
    }

    public static function writeJson(array $data): void
    {
        $path = self::jsonPath();
        $dir = dirname($path);

        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        self::$jsonCache = $data;
    }

    public static function defaultStore(): array
    {
        $seoPages = config('seo.pages', []);
        $pageSeo = [];

        foreach ($seoPages as $key => $page) {
            $pageSeo[] = array_merge(['page_key' => $key], $page);
        }

        return [
            'site_settings' => [
                'company_name' => 'Electronic Safety & Security Pvt. Ltd.',
                'brand_name' => 'ESS-TRACK',
                'phone' => '021-34330887',
                'email' => 'info@esspl.com.pk',
                'address' => 'Suite 201, Kawish Crown, Block 6 PECHS, Karachi',
                'facebook' => 'https://www.facebook.com/ESSTRACKPAKISTAN',
                'whatsapp' => 'https://wa.me/923342011104',
                'default_og_image' => '/images/og-default.jpg',
            ],
            'page_seo' => $pageSeo,
            'page_content' => [],
            'blog_posts' => self::defaultBlogPosts(),
            'success_stories' => [],
            'promotions' => [],
            'chatbot_faqs' => self::defaultChatFaqs(),
            'analytics_views' => [],
            'chatbot_logs' => [],
        ];
    }

    public static function defaultBlogPosts(): array
    {
        return [
            [
                'id' => 1,
                'slug' => 'why-ess-track-is-best-gps-tracking-pakistan',
                'title' => 'Why ESS-Track is the Best GPS Vehicle Tracking System in Pakistan',
                'excerpt' => 'Discover what makes ESS-Track the top choice for fleet owners, logistics companies, and individual vehicle owners across Pakistan.',
                'content' => '<p>When searching for the <strong>best ESS Track</strong> solution in Pakistan, businesses need reliability, nationwide coverage, and 24/7 support. ESS-Track by ESSPL delivers all three, backed by 15+ years of experience since 2009.</p><p>Our 3G-2G hybrid tracking platform keeps your vehicles connected even in remote areas. Real-time location, speed alerts, geofencing, and engine immobilization give you complete control over your fleet.</p><p>Whether you manage a single car or hundreds of commercial vehicles, ESS-Track scales with your needs through Basic, Silver, and Gold packages.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=800&q=80',
                'author' => 'ESS-Track Team',
                'status' => 'published',
                'meta_title' => 'Why ESS-Track is the Best GPS Tracking in Pakistan',
                'meta_description' => 'ESS-Track by ESSPL is Pakistan\'s best GPS vehicle tracking system with 24/7 monitoring and nationwide coverage.',
                'published_at' => '2025-11-10 10:00:00',
            ],
            [
                'id' => 2,
                'slug' => 'fleet-management-tips-pakistan-2025',
                'title' => '5 Fleet Management Tips for Pakistani Businesses in 2025',
                'excerpt' => 'Practical strategies to reduce fuel costs, prevent theft, and improve driver accountability using GPS tracking.',
                'content' => '<p>Effective fleet management starts with visibility. Pakistani logistics and delivery companies are increasingly adopting GPS tracking to stay competitive.</p><p><strong>Tip 1:</strong> Set geofence alerts for depots and customer zones.<br><strong>Tip 2:</strong> Monitor idle time to cut fuel waste.<br><strong>Tip 3:</strong> Review speed reports weekly.<br><strong>Tip 4:</strong> Use route history for dispute resolution.<br><strong>Tip 5:</strong> Choose a provider with local 24/7 support, like ESS-Track.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&q=80',
                'author' => 'ESS-Track Team',
                'status' => 'published',
                'meta_title' => 'Fleet Management Tips Pakistan 2025 | ESS-Track',
                'meta_description' => 'Five proven fleet management tips for Pakistani businesses using GPS vehicle tracking.',
                'published_at' => '2025-12-05 10:00:00',
            ],
            [
                'id' => 3,
                'slug' => 'how-gps-tracking-prevents-vehicle-theft',
                'title' => 'How GPS Tracking Prevents Vehicle Theft in Pakistan',
                'excerpt' => 'Learn how real-time tracking and instant alerts help recover stolen vehicles faster and deter criminals.',
                'content' => '<p>Vehicle theft remains a serious concern across Pakistan\'s major cities. GPS tracking adds a critical layer of security that traditional alarms cannot match.</p><p>With ESS-Track, owners receive instant notifications when a vehicle moves outside designated areas or during unauthorized hours. Our monitoring team can assist with location sharing for law enforcement.</p><p>Engine immobilization features available on select packages add another deterrent, stopping thieves before they get far.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&q=80',
                'author' => 'ESS-Track Team',
                'status' => 'published',
                'meta_title' => 'GPS Tracking Prevents Vehicle Theft | ESS-Track',
                'meta_description' => 'How ESS-Track GPS vehicle tracking helps prevent and recover stolen vehicles in Pakistan.',
                'published_at' => '2026-01-20 10:00:00',
            ],
        ];
    }
    public static function defaultChatFaqs(): array
    {
        return [
            ['id' => 1, 'question' => 'What is ESS-Track?', 'answer' => 'ESS-Track by ESSPL is Pakistan\'s GPS vehicle tracking service since 2009. We provide real-time monitoring, 24/7 control room, and packages for cars, trucks, and fleets.', 'keywords' => 'ess-track,what is,gps,esspl', 'status' => 'active', 'sort_order' => 1],
            ['id' => 2, 'question' => 'What packages do you offer?', 'answer' => 'We offer Rental Packages and With Device Packages. Rental: Basic/Silver (PKR 14,500), Standard/Gold (PKR 18,500), Premium/Platinum (PKR 35,000), Corporate Fleet (PKR 18,500/vehicle). Visit our Packages page for full details.', 'keywords' => 'package,packages,offer,plan', 'status' => 'active', 'sort_order' => 2],
            ['id' => 3, 'question' => 'What is the price of Basic Silver package?', 'answer' => 'Basic / Silver Rental Package total is PKR 14,500 including installation PKR 2,500, connection PKR 1,000, commissioning PKR 1,000, and annual monitoring PKR 10,000. VTU unit is PKR 0 on rental plan.', 'keywords' => 'silver,basic,14500,price,rental,starter', 'status' => 'active', 'sort_order' => 3],
            ['id' => 4, 'question' => 'What is the price of Gold package?', 'answer' => 'Standard / Gold Rental Package total is PKR 18,500. It includes all Silver features plus European technology software, live map status, mileage registration, engine alerts, and free mobile app.', 'keywords' => 'gold,standard,18500,price,popular', 'status' => 'active', 'sort_order' => 4],
            ['id' => 5, 'question' => 'What is Platinum package price?', 'answer' => 'Premium / Platinum Rental Package total is PKR 35,000. Includes VTU with microphone PKR 15,500, all Gold features, auto call alerts for bonnet/engine, customer shutdown access, and dedicated account manager.', 'keywords' => 'platinum,premium,35000,advanced', 'status' => 'active', 'sort_order' => 5],
            ['id' => 6, 'question' => 'What is included in Silver package?', 'answer' => 'Silver/Basic includes: 24/7 control room monitoring, geo fence alerts, vehicle recovery help with police, system upgrades, remote vehicle shutdown, and data plan included.', 'keywords' => 'silver,features,included,basic', 'status' => 'active', 'sort_order' => 6],
            ['id' => 7, 'question' => 'Rental vs With Device packages?', 'answer' => 'Rental Packages: VTU unit often PKR 0, you pay total package price. With Device Packages: you purchase the GPS device plus installation and monitoring fees. Toggle on Packages page to compare both.', 'keywords' => 'rental,device,difference,compare', 'status' => 'active', 'sort_order' => 7],
            ['id' => 8, 'question' => 'How to book or order?', 'answer' => 'Click Book Now on any package on our Packages page, fill the service agreement form, verify OTP on your mobile, and submit. Or contact us at 021-34330887 or WhatsApp 0334-2011104.', 'keywords' => 'book,order,buy,install,how to', 'status' => 'active', 'sort_order' => 8],
            ['id' => 9, 'question' => 'How to contact ESS-Track?', 'answer' => 'Phone: 021-34330887-88 | Email: info@esspl.com.pk | WhatsApp: 0334-2011104 | Office: Suite 201, Kawish Crown, Block 6 PECHS, Karachi.', 'keywords' => 'contact,phone,whatsapp,email,address,call', 'status' => 'active', 'sort_order' => 9],
            ['id' => 10, 'question' => 'Do you have any active offers?', 'answer' => 'No active offer is available right now. For current package details, please contact us at 021-34330887 or WhatsApp 0334-2011104.', 'keywords' => 'promo,discount,offer', 'status' => 'active', 'sort_order' => 10],
            ['id' => 11, 'question' => 'What vehicles can be tracked?', 'answer' => 'We track cars, sedans, SUVs, pickups, trucks, buses, coaches, and motorcycles. Corporate fleet solutions available for bulk vehicles.', 'keywords' => 'vehicle,car,truck,bus,bike,fleet,motorcycle', 'status' => 'active', 'sort_order' => 11],
            ['id' => 12, 'question' => 'Is GPS tracking available all over Pakistan?', 'answer' => 'Yes, ESS-Track provides nationwide GPS tracking coverage across Pakistan with 24/7 monitoring call center support.', 'keywords' => 'pakistan,nationwide,coverage,area,city', 'status' => 'active', 'sort_order' => 12],
        ];
    }

    public static function ensureJsonStore(): void
    {
        if (! file_exists(self::jsonPath())) {
            self::writeJson(self::defaultStore());

            return;
        }

        $store = self::readJson();
        $changed = false;

        if (count($store['chatbot_faqs'] ?? []) < 8) {
            $store['chatbot_faqs'] = self::defaultChatFaqs();
            $changed = true;
        }

        if (! array_key_exists('promotions', $store)) {
            $store['promotions'] = self::defaultStore()['promotions'];
            $changed = true;
        }

        if ($changed) {
            self::writeJson($store);
        }
    }
}
