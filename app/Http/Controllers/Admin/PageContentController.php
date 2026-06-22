<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CmsRepository;
use App\Services\MediaStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PageContentController extends Controller
{
    private array $pages = [
        'home' => 'Home Page',
        'about' => 'About Page',
        'services' => 'Packages Page',
        'tracker' => 'Vehicle Tracker Page',
        'contact' => 'Contact Page',
        'global' => 'Global Labels & Shared Content',
    ];

    private function fields(string $pageKey): array
    {
        $fields = [
            'home' => [
                'hero' => [
                    'Hero Label' => ['hero_label', 'text', 'Expert Tracking Solutions'],
                    'Hero Title HTML' => ['hero_title_html', 'textarea', 'Precision <span style="color:var(--or);">Vehicle Tracking</span> System Expert'],
                    'Hero Description' => ['hero_description', 'textarea', 'ESS-TRACK BY ESSPL provides state-of-the-art surveillance and tracking facilities across Pakistan, utilizing advanced 3G-2G communication platforms.'],
                    'Hero Video URL' => ['hero_video_url', 'media', 'images/hero-video.mp4'],
                    'Primary Button Text' => ['hero_primary_button', 'text', 'View Tracker'],
                    'Secondary Button Text' => ['hero_secondary_button', 'text', 'Our Packages'],
                    'Stat 1 Number' => ['stat_1_number', 'text', '15+'],
                    'Stat 1 Label' => ['stat_1_label', 'text', 'Years Exp'],
                    'Stat 2 Number' => ['stat_2_number', 'text', '50k+'],
                    'Stat 2 Label' => ['stat_2_label', 'text', 'Tracked'],
                    'Stat 3 Number' => ['stat_3_number', 'text', '24/7'],
                    'Stat 3 Label' => ['stat_3_label', 'text', 'Support'],
                ],
                'features' => [
                    'Features Label' => ['features_label', 'text', 'Advanced Capabilities'],
                    'Features Title' => ['features_title', 'text', 'Premium Tracking Features'],
                    'Features Description' => ['features_description', 'textarea', 'Our ecosystem is built to give you total control and peace of mind with enterprise-grade security.'],
                    'Feature 1 Title' => ['feature_1_title', 'text', 'Real-Time Tracking'],
                    'Feature 1 Text' => ['feature_1_text', 'textarea', "Get pinpoint accuracy of your vehicle's location on live maps with 24/7 monitoring capabilities."],
                    'Feature 2 Title' => ['feature_2_title', 'text', 'Proactive Alerts'],
                    'Feature 2 Text' => ['feature_2_text', 'textarea', 'Immediate notifications for battery tampering, ignition status, and geofence boundary crossings.'],
                    'Feature 3 Title' => ['feature_3_title', 'text', 'Detailed History'],
                    'Feature 3 Text' => ['feature_3_text', 'textarea', 'Access 90 days of route history with speed analysis, stop duration, and trip reports.'],
                ],
                'cta' => [
                    'Support Label' => ['support_label', 'text', '24/7 Command Center'],
                    'Support Title HTML' => ['support_title_html', 'textarea', 'Always Guarding <br>What Matters To You'],
                    'Support Description' => ['support_description', 'textarea', "Our dedicated support team is always ready. In case of any violation or theft attempt, we reach out to you immediately to ensure your vehicle's safety."],
                    'App Image URL' => ['app_image_url', 'media', 'images/app-interface.png'],
                    'App Label' => ['app_label', 'text', 'Mobile Control'],
                    'App Title HTML' => ['app_title_html', 'textarea', 'Track Your Vehicle <br>On The Go'],
                    'App Description' => ['app_description', 'textarea', 'Download our mobile application to get real-time location, speed reports, and instant notifications right in your pocket. Compatible with Android & iOS.'],
                    'Final CTA Title' => ['cta_title', 'text', 'Ready To Experience The Best Tracking?'],
                    'Final CTA Text' => ['cta_description', 'textarea', 'Contact us today for a free demonstration and customized fleet solutions.'],
                    'Final CTA Button' => ['cta_button', 'text', 'Get Started Now'],
                ],
            ],
            'about' => [
                'hero' => [
                    'Hero Label' => ['hero_label', 'text', 'Our Story'],
                    'Hero Title HTML' => ['hero_title_html', 'textarea', 'Dedicated To <span style="color: var(--or);">Your Safety</span>'],
                    'Hero Description' => ['hero_description', 'textarea', "Since 2009, ESS-TRACK BY ESSPL has been Pakistan's leading provider of vehicle security and fleet management solutions."],
                ],
                'story' => [
                    'Story Label' => ['story_label', 'text', 'Who We Are'],
                    'Story Title' => ['story_title', 'text', 'Excellence In Surveillance'],
                    'Story Paragraph 1' => ['story_p1', 'textarea', 'Electronic Safety & Security Pvt. Ltd. (ESSPL) was established with a clear vision: to provide the most reliable and technologically advanced security solutions to the people of Pakistan.'],
                    'Story Paragraph 2' => ['story_p2', 'textarea', 'We specialize in GPS-based tracking systems, utilizing the latest 3G/2G communication platforms. Our systems are designed to provide unmatched precision, whether you are tracking a single car or managing a commercial fleet of hundreds.'],
                    'Story Image URL' => ['story_image_url', 'media', 'https://images.unsplash.com/photo-1521737711867-e3b97375f902?q=80&w=1000&auto=format&fit=crop'],
                    'Mission Text' => ['mission_text', 'textarea', 'To empower vehicle owners with real-time data and security tools that protect their assets.'],
                    'Vision Text' => ['vision_text', 'textarea', 'To be the undisputed leader in GPS tracking by delivering innovation and trust.'],
                ],
                'sections' => [
                    'Advantage Label' => ['advantage_label', 'text', 'The ESS Advantage'],
                    'Advantage Title' => ['advantage_title', 'text', 'Why Thousands Trust Us'],
                    'Expertise Image URL' => ['expertise_image_url', 'media', 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1000&auto=format&fit=crop'],
                    'Expertise Label' => ['expertise_label', 'text', 'Expertise'],
                    'Expertise Title' => ['expertise_title', 'text', 'Our Technical Prowess'],
                    'Expertise Description' => ['expertise_description', 'textarea', 'Behind the screens at ESS-TRACK BY ESSPL is a team of software engineers, hardware experts, and security specialists working tirelessly to maintain our 99.9% uptime.'],
                    'CTA Title' => ['cta_title', 'text', "Partner With Pakistan's Most Trusted Tracker"],
                    'CTA Button Text' => ['cta_button', 'text', 'Get Started Today'],
                ],
            ],
            'services' => [
                'hero' => [
                    'Hero Label' => ['hero_label', 'text', 'Pricing Plans'],
                    'Hero Title HTML' => ['hero_title_html', 'textarea', 'Choose Your <span style="color: var(--or);">Tracking Package</span>'],
                    'Hero Description' => ['hero_description', 'textarea', 'Select the perfect plan for your vehicle security and fleet management needs. Transparent pricing with no hidden charges.'],
                    'Rental Button Text' => ['rental_button', 'text', 'Rental Packages'],
                    'Device Button Text' => ['device_button', 'text', 'With Device Packages'],
                ],
                'packages' => [
                    'Packages JSON' => ['packages_json', 'json', json_encode($this->defaultPackages(), JSON_PRETTY_PRINT)],
                    'Add-ons JSON' => ['addons_json', 'json', json_encode($this->defaultAddons(), JSON_PRETTY_PRINT)],
                    'Custom Solution Title' => ['custom_title', 'text', 'Enterprise Custom Solutions'],
                    'Custom Solution Items' => ['custom_items', 'textarea', 'Custom Geo Fencing, White-label Solutions, ERP Integration, Fleet Dashboards'],
                    'Custom Quote Button' => ['custom_button', 'text', 'Request Custom Quote'],
                ],
            ],
            'tracker' => [
                'hero' => [
                    'Hero Label' => ['hero_label', 'text', 'Advanced Monitoring'],
                    'Hero Title HTML' => ['hero_title_html', 'textarea', 'Elite Vehicle <span style="color: var(--or);">Tracker</span>'],
                    'Hero Description' => ['hero_description', 'textarea', 'Experience the next generation of GPS tracking with real-time analytics, theft prevention, and fleet optimization tools.'],
                ],
                'content' => [
                    'Control Label' => ['control_label', 'text', 'Smart Monitoring'],
                    'Control Title' => ['control_title', 'text', 'Real-Time Control Panel'],
                    'Control Description' => ['control_description', 'textarea', 'Our web and mobile interface allows you to stay connected to your vehicle 24/7. Watch movements as they happen, check ignition status, and set custom boundaries.'],
                    'Control Image URL' => ['control_image_url', 'media', 'https://images.unsplash.com/photo-1556761175-b413da4baf72?q=80&w=1000&auto=format&fit=crop'],
                    'Demo Button Text' => ['demo_button', 'text', 'Request Demo'],
                    'Specs Label' => ['specs_label', 'text', 'Specifications'],
                    'Specs Title' => ['specs_title', 'text', 'The Hardware Excellence'],
                    'Specs Description' => ['specs_description', 'textarea', 'We use the most reliable tracking hardware in Pakistan, tested for extreme conditions.'],
                    'CTA Title' => ['cta_title', 'text', 'Get Your Advanced Tracker Installed Today'],
                    'CTA Button Text' => ['cta_button', 'text', 'Book Installation Now'],
                    'Installation Image URL' => ['installation_image_url', 'media', 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=1000&auto=format&fit=crop'],
                    'Installation Label' => ['installation_label', 'text', 'Professional Installation'],
                    'Installation Title' => ['installation_title', 'text', 'Installed By Trained Technicians'],
                    'Installation Description' => ['installation_description', 'textarea', 'Our trained technicians install and test every tracker so your vehicle is ready for monitoring.'],
                    'Quote Text' => ['quote_text', 'textarea', 'Real-time tracking gives vehicle owners confidence and control.'],
                    'Quote Author' => ['quote_author', 'text', 'ESS-Track Support Team'],
                ],
            ],
            'contact' => [
                'hero' => [
                    'Hero Label' => ['hero_label', 'text', 'Get In Touch'],
                    'Hero Title HTML' => ['hero_title_html', 'textarea', 'We Are <span style="color: var(--or);">Here To Help</span>'],
                    'Hero Description' => ['hero_description', 'textarea', 'Have questions about our tracking systems or need technical support? Reach out to our expert team anytime.'],
                    'Info Box Title' => ['info_title', 'text', 'Contact Information'],
                    'Form Title' => ['form_title', 'text', 'Send Us a Message'],
                    'Form Intro' => ['form_intro', 'textarea', 'Fill out the form and our team will get back to you within 24 hours.'],
                    'Map Placeholder Title' => ['map_title', 'text', 'Google Maps Integration Here'],
                ],
            ],
            'global' => [
                'navigation' => [
                    'Nav Home' => ['nav_home', 'text', 'Home'],
                    'Nav Vehicle Tracker' => ['nav_tracker', 'text', 'Vehicle Tracker'],
                    'Nav Packages' => ['nav_packages', 'text', 'Packages'],
                    'Nav About' => ['nav_about', 'text', 'About Us'],
                    'Nav Blog' => ['nav_blog', 'text', 'Blog'],
                    'Nav Success Stories' => ['nav_success_stories', 'text', 'Success Stories'],
                    'Nav Contact' => ['nav_contact', 'text', 'Contact Us'],
                ],
                'footer' => [
                    'Footer Description' => ['footer_description', 'textarea', "Electronic Safety & Security Pvt. Ltd. Pakistan's trusted GPS vehicle tracking company since 2009."],
                    'Footer Pages Title' => ['footer_pages_title', 'text', 'Pages'],
                    'Footer Packages Title' => ['footer_packages_title', 'text', 'Our Packages'],
                    'Footer Contact Title' => ['footer_contact_title', 'text', 'Contact Info'],
                    'Footer Rights Text' => ['footer_rights_text', 'text', 'All rights reserved.'],
                ],
                'promo_popup' => [
                    'Promo Badge' => ['promo_badge', 'text', 'Special Offer - 2026'],
                    'Promo Title Line 1' => ['promo_title_line_1', 'text', 'Choose Your'],
                    'Promo Title Line 2' => ['promo_title_line_2', 'text', 'Tracking Package'],
                    'Promo Description' => ['promo_description', 'textarea', "Pakistan's trusted GPS vehicle tracking company. Real-time monitoring, 24/7 support, and clear package options."],
                    'Promo Stat 1 Number' => ['promo_stat_1_number', 'text', '15+'],
                    'Promo Stat 1 Label' => ['promo_stat_1_label', 'text', 'Years Active'],
                    'Promo Stat 2 Number' => ['promo_stat_2_number', 'text', '5000+'],
                    'Promo Stat 2 Label' => ['promo_stat_2_label', 'text', 'Vehicles'],
                    'Promo Stat 3 Number' => ['promo_stat_3_number', 'text', '24/7'],
                    'Promo Stat 3 Label' => ['promo_stat_3_label', 'text', 'Monitoring'],
                    'Promo Stat 4 Number' => ['promo_stat_4_number', 'text', '100%'],
                    'Promo Stat 4 Label' => ['promo_stat_4_label', 'text', 'Secure'],
                    'Promo Trust Text' => ['promo_trust_text', 'text', 'ESS-TRACK by ESSPL - Certified & Trusted'],
                    'Promo View All Button' => ['promo_view_all_button', 'text', 'View All Packages'],
                    'Promo Rental Tab' => ['promo_rental_tab', 'text', 'Rental'],
                    'Promo Device Tab' => ['promo_device_tab', 'text', 'With Device'],
                    'Promo Rental Section Title' => ['promo_rental_title', 'text', 'Rental Packages'],
                    'Promo Device Section Title' => ['promo_device_title', 'text', 'With Device Packages'],
                    'Promo Add-ons Section Title' => ['promo_addons_title', 'text', 'Add-on Devices'],
                    'Promo Package Button' => ['promo_package_button', 'text', 'Book Now'],
                ],
                'agreement' => [
                    'Agreement Modal Title' => ['agreement_modal_title', 'text', 'Service Agreement'],
                    'Agreement Modal Subtitle' => ['agreement_modal_subtitle', 'text', 'ESS-TRACK BY ESSPL Comprehensive Tracking Solutions'],
                    'Customer Details Heading' => ['agreement_customer_heading', 'text', 'Customer Details:'],
                    'Customer Numbers Heading' => ['agreement_numbers_heading', 'text', 'Customer Numbers:'],
                    'Terms Heading' => ['agreement_terms_heading', 'text', 'Terms & Conditions of Service (SLA):'],
                    'View Full Screen Text' => ['agreement_view_full_text', 'text', 'View Full Screen'],
                    'Agreement Checkbox Text' => ['agreement_checkbox_text', 'textarea', 'I have read and agree to the Terms & Conditions / Service Level Agreement (SLA). I confirm that all information provided is accurate and I authorize ESS-Track to proceed with the service.'],
                    'Submit Agreement Button' => ['agreement_submit_button', 'text', 'Sign & Place Order via WhatsApp'],
                    'Close Agreement Button' => ['agreement_close_button', 'text', 'Close Agreement'],
                    'Custom SLA HTML Override' => ['agreement_custom_html', 'html', ''],
                ],
            ],
        ];

        return $fields[$pageKey] ?? [];
    }

    public function index(CmsRepository $cms)
    {
        return view('admin.pages.index', ['pages' => $this->pages]);
    }

    public function edit(string $pageKey, CmsRepository $cms)
    {
        abort_unless(isset($this->pages[$pageKey]), 404);

        return view('admin.pages.edit', [
            'pageKey' => $pageKey,
            'pageName' => $this->pages[$pageKey],
            'fieldGroups' => $this->fields($pageKey),
            'content' => $cms->pageContent($pageKey),
        ]);
    }

    public function update(Request $request, string $pageKey, CmsRepository $cms, MediaStorageService $media)
    {
        abort_unless(isset($this->pages[$pageKey]), 404);

        $fields = $this->fields($pageKey);
        $data = $request->except('_token');

        foreach ($fields as $group => $items) {
            foreach ($items as $label => [$fieldKey, $type, $default]) {
                if ($request->hasFile($fieldKey . '_file')) {
                    $file = $request->file($fieldKey . '_file');
                    $request->validate([
                        $fieldKey . '_file' => [
                            'file',
                            'mimetypes:image/jpeg,image/png,image/gif,image/webp,video/mp4,video/webm',
                            'max:' . config('media.max_upload_kb'),
                        ],
                    ]);
                    $data[$fieldKey] = $media->store($file);
                }

                if (! array_key_exists($fieldKey, $data)) {
                    $data[$fieldKey] = $default;
                }

                if ($type === 'json' && $data[$fieldKey] !== '') {
                    json_decode($data[$fieldKey], true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        return back()->withInput()->with('error', $label . ' valid JSON nahi hai.');
                    }
                }
            }
        }

        $cms->savePageContent($pageKey, $fields, $data);
        Artisan::call('view:clear');
        Artisan::call('cache:clear');

        return back()->with('success', $this->pages[$pageKey] . ' saved. Website page reload karke change check karein.');
    }

    private function defaultPackages(): array
    {
        return [
            ['type' => 'rental', 'badge' => 'Starter', 'name' => 'Basic / Silver', 'price' => 'PKR 14,500', 'unit' => '/Total', 'popular' => false, 'breakdown' => [['VTU Unit', 'PKR 0'], ['Installation', 'PKR 2,500'], ['Connection Fee', 'PKR 1,000'], ['Commissioning', 'PKR 1,000'], ['Annual Monitoring', 'PKR 10,000']], 'features' => ['24/7 Control Room Monitoring', 'Call on Geo Fence Alerts', 'Vehicle Recovery Help (Police)', 'System Upgrades', 'Remote Vehicle Shutdown', 'Data plan included']],
            ['type' => 'rental', 'badge' => 'Most Popular', 'name' => 'Standard / Gold', 'price' => 'PKR 18,500', 'unit' => '/Total', 'popular' => true, 'breakdown' => [['VTU Unit', 'PKR 0'], ['Installation', 'PKR 2,500'], ['Connection Fee', 'PKR 2,000'], ['Commissioning', 'PKR 2,000'], ['Annual Monitoring', 'PKR 12,000']], 'features' => ['All Silver Features', 'European Technology Software', 'Live Status on Map', 'Mileage Registration', 'Engine ON/OFF Alerts', '30 Days Data Storage', 'Mobile Application (FREE)']],
            ['type' => 'rental', 'badge' => 'Advanced', 'name' => 'Premium / Platinum', 'price' => 'PKR 35,000', 'unit' => '/Total', 'popular' => false, 'breakdown' => [['VTU (Microphone)', 'PKR 15,500'], ['Installation', 'PKR 2,500'], ['Connection Fee', 'PKR 2,000'], ['Commissioning', 'PKR 2,000'], ['Annual Monitoring', 'PKR 13,000']], 'features' => ['All Gold Features', 'Auto Calls Alert (Bonnet Open)', 'Auto Calls Alert (Engine ON)', 'Customer Access Shutdown', 'Maintenance Reminders', 'Dedicated Account Manager']],
            ['type' => 'rental', 'badge' => 'Bulk Fleet', 'name' => 'Corporate Fleet', 'price' => 'PKR 18,500', 'unit' => '/Vehicle', 'popular' => false, 'breakdown' => [['Multi-Vehicle Unit', 'PKR 0'], ['Installation (On-site)', 'PKR 2,500'], ['Service Setup', 'PKR 4,000'], ['Annual Monitoring', 'PKR 12,000']], 'features' => ['100+ Vehicles Management', 'Refrigerated / Reefer Truck Solution', 'Temperature Monitoring (Real-time)', 'SLA-Based Dedicated Support', 'Custom Reports & Dashboards', 'Priority Help Desk', 'Training for Staff']],
            ['type' => 'device', 'badge' => '', 'name' => 'Basic / Silver', 'price' => 'PKR 27,000', 'unit' => '/Total', 'popular' => false, 'breakdown' => [['VTU Unit', 'PKR 13,000'], ['Battery 12v', 'PKR 1,500'], ['Installation', 'PKR 2,500'], ['Monitoring', 'PKR 8,000']], 'features' => ['24/7 Control Room Monitoring', 'Geo Fence Alerts', 'Vehicle Recovery Assistance', 'Remote Vehicle Shutdown', 'Data plan included']],
            ['type' => 'device', 'badge' => '', 'name' => 'Standard / Gold', 'price' => 'PKR 31,000', 'unit' => '/Total', 'popular' => true, 'breakdown' => [['VTU Unit', 'PKR 13,000'], ['Battery 12v', 'PKR 1,500'], ['Monitoring', 'PKR 10,000'], ['Setup Fees', 'PKR 6,500']], 'features' => ['All Silver Features', 'European Technology Software', 'Engine ON/OFF Alerts', '30 Days Trip History', 'Mobile App Integration']],
            ['type' => 'device', 'badge' => '', 'name' => 'Premium / Platinum', 'price' => 'PKR 36,500', 'unit' => '/Total', 'popular' => false, 'breakdown' => [['VTU (Microphone)', 'PKR 15,500'], ['Battery 12v', 'PKR 1,500'], ['Monitoring', 'PKR 11,000'], ['Setup Fees', 'PKR 8,500']], 'features' => ['All Gold Features', 'Voice Monitoring Support', 'Customer Access Shutdown', 'Dedicated Manager']],
            ['type' => 'device', 'badge' => '', 'name' => 'Corporate Fleet', 'price' => 'PKR 33,000', 'unit' => '/Total', 'popular' => false, 'breakdown' => [['VTU Unit', 'PKR 13,000'], ['Battery 12v', 'PKR 1,500'], ['Monitoring', 'PKR 12,000'], ['Service Setup', 'PKR 6,500']], 'features' => ['100+ Vehicles Support', 'SLA-based Priority Support', 'Custom API Integration']],
            ['type' => 'device', 'badge' => '', 'name' => 'Self-Monitoring', 'price' => 'PKR 25,000', 'unit' => '/Total', 'popular' => false, 'breakdown' => [['VTU Unit', 'PKR 13,000'], ['Battery 12v', 'PKR 1,500'], ['Installation', 'PKR 2,500'], ['Annual Hosting', 'PKR 4,000']], 'features' => ['Direct Mobile Control', 'No Control Room Needed', 'European Tech Access', 'Remote Shutdown Access']],
        ];
    }

    private function defaultAddons(): array
    {
        return [
            ['name' => 'Dash Cam Tracker', 'price' => 'PKR 45,000', 'description' => 'Audio/Video Monitoring'],
            ['name' => 'AI Dash Cam', 'price' => 'PKR 120,000', 'description' => 'Advanced AI Monitoring'],
            ['name' => 'Temperature Sensor', 'price' => 'PKR 6,500', 'description' => 'For cold chain logistics'],
        ];
    }
}
