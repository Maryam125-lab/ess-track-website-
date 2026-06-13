<?php

namespace App\Services;

use App\Models\CmsPageSeo;

class SeoService
{
    public function forPage(string $pageKey, array $overrides = []): array
    {
        $defaults = config('seo.pages.' . $pageKey, []);
        $siteUrl = rtrim(config('seo.site_url'), '/');
        $settings = $this->siteSettings();
        $siteName = $this->cleanText($settings['brand_name'] ?? config('seo.site_name'));
        $defaultImage = $settings['default_og_image'] ?? config('seo.default_og_image');

        $db = $this->getPageSeoFromStorage($pageKey);

        $metaTitle = $overrides['meta_title']
            ?? $db['meta_title']
            ?? $defaults['meta_title']
            ?? $siteName;

        $metaDescription = $overrides['meta_description']
            ?? $db['meta_description']
            ?? $defaults['meta_description']
            ?? '';

        $ogTitle = $overrides['og_title']
            ?? $db['og_title']
            ?? $defaults['og_title']
            ?? $metaTitle;

        $ogDescription = $overrides['og_description']
            ?? $db['og_description']
            ?? $defaults['og_description']
            ?? $metaDescription;

        $ogImage = $overrides['og_image']
            ?? $db['og_image']
            ?? $defaults['og_image']
            ?? $defaultImage;

        $keywords = $overrides['keywords']
            ?? $db['keywords']
            ?? $defaults['keywords']
            ?? '';

        $path = request()->path();
        $canonical = $overrides['canonical'] ?? $siteUrl . (($path === '/' || $path === '') ? '' : '/' . $path);

        if (! str_starts_with($canonical, 'http')) {
            $canonical = $siteUrl . '/' . ltrim($canonical, '/');
        }

        if (! str_starts_with($ogImage, 'http')) {
            $ogImage = $siteUrl . '/' . ltrim($ogImage, '/');
        }

        return [
            'meta_title' => $this->applyBrand($this->cleanText($metaTitle), $siteName),
            'meta_description' => $this->applyBrand($this->cleanText($metaDescription), $siteName),
            'og_title' => $this->applyBrand($this->cleanText($ogTitle), $siteName),
            'og_description' => $this->applyBrand($this->cleanText($ogDescription), $siteName),
            'og_image' => $ogImage,
            'og_url' => $canonical,
            'keywords' => $this->cleanText($keywords),
            'canonical' => $canonical,
            'site_name' => $siteName,
            'twitter_handle' => config('seo.twitter_handle'),
        ];
    }

    public function organizationSchema(): array
    {
        $org = $this->organization();
        $siteUrl = rtrim(config('seo.site_url'), '/');

        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $org['name'],
            'alternateName' => $org['brand'],
            'url' => $siteUrl,
            'logo' => $siteUrl . '/images/logo.png',
            'description' => $org['brand'] . ' is Pakistan\'s GPS vehicle tracking system by ESSPL, trusted since 2009 for fleet management and real-time monitoring.',
            'foundingDate' => $org['founding_date'],
            'telephone' => $org['telephone'],
            'email' => $org['email'],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $org['address'],
                'addressCountry' => 'PK',
            ],
            'areaServed' => $org['area_served'],
            'sameAs' => [
                'https://www.facebook.com/ESSTRACKPAKISTAN',
                'https://www.esspl.com.pk',
            ],
        ];
    }

    public function websiteSchema(): array
    {
        $siteUrl = rtrim(config('seo.site_url'), '/');
        $org = $this->organization();
        $brand = $org['brand'];

        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $brand . ' - Best GPS Vehicle Tracking Pakistan',
            'alternateName' => [$brand, 'ESS Track', 'ESSPL Tracking'],
            'url' => $siteUrl,
            'description' => 'Pakistan\'s GPS vehicle tracking system by ESSPL. Real-time monitoring, fleet management, and 24/7 support.',
            'publisher' => [
                '@type' => 'Organization',
                'name' => $org['name'],
            ],
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => $siteUrl . '/blog?q={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    public function serviceSchema(): array
    {
        $siteUrl = rtrim(config('seo.site_url'), '/');
        $brand = $this->organization()['brand'];

        return [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $brand . ' GPS Vehicle Tracking',
            'provider' => [
                '@type' => 'Organization',
                'name' => $this->organization()['name'],
            ],
            'description' => 'GPS vehicle tracking and fleet management service in Pakistan with 24/7 monitoring and nationwide coverage.',
            'areaServed' => 'Pakistan',
            'url' => $siteUrl,
            'serviceType' => 'GPS Vehicle Tracking',
        ];
    }

    public function articleSchema(array $post): array
    {
        $siteUrl = rtrim(config('seo.site_url'), '/');
        $image = $post['image_url'] ?? config('seo.default_og_image');
        $org = $this->organization();

        if ($image && ! str_starts_with($image, 'http')) {
            $image = $siteUrl . '/' . ltrim($image, '/');
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $post['title'],
            'description' => $post['excerpt'] ?? $post['meta_description'] ?? '',
            'image' => $image,
            'author' => [
                '@type' => 'Organization',
                'name' => $post['author'] ?? $org['brand'] . ' Team',
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => $org['name'],
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => $siteUrl . '/images/logo.png',
                ],
            ],
            'datePublished' => $post['published_at'] ?? now()->toIso8601String(),
            'mainEntityOfPage' => $siteUrl . '/blog/' . $post['slug'],
        ];
    }

    protected function getPageSeoFromStorage(string $pageKey): array
    {
        if (CmsStorage::usesDatabase()) {
            $row = CmsPageSeo::where('page_key', $pageKey)->first();

            return $row ? $row->toArray() : [];
        }

        $store = CmsStorage::readJson();

        foreach ($store['page_seo'] ?? [] as $page) {
            if (($page['page_key'] ?? '') === $pageKey) {
                return $page;
            }
        }

        return [];
    }

    protected function siteSettings(): array
    {
        try {
            return app(CmsRepository::class)->getSettings();
        } catch (\Throwable $e) {
            return [];
        }
    }

    protected function organization(): array
    {
        $settings = $this->siteSettings();
        $org = config('seo.organization');

        return array_merge($org, [
            'name' => $this->cleanText($settings['company_name'] ?? $org['name']),
            'brand' => $this->cleanText($settings['brand_name'] ?? $org['brand']),
            'telephone' => $this->cleanText($settings['phone'] ?? $org['telephone']),
            'email' => $this->cleanText($settings['email'] ?? $org['email']),
            'address' => $this->cleanText($settings['address'] ?? $org['address']),
        ]);
    }

    protected function cleanText(?string $value): string
    {
        $value = (string) $value;
        $replacements = [
            'â€”' => '-',
            'â€“' => '-',
            'â€"' => '-',
            'â€' => '',
            'Â·' => '-',
            'Â' => '',
            '—' => '-',
            '–' => '-',
        ];

        return trim(preg_replace('/\s+/', ' ', str_replace(array_keys($replacements), array_values($replacements), $value)));
    }

    protected function applyBrand(string $value, string $brand): string
    {
        if ($brand === '') {
            return $value;
        }

        $value = trim(preg_replace([
            '/ESS-TRACK BY ESSPL/i',
            '/ESS-TRACK/i',
            '/ESS-Track/i',
            '/ESS Track/i',
        ], $brand, $value));

        return preg_replace('/^(' . preg_quote($brand, '/') . ')\s+(?=(Best|GPS|Blog|Success|Live|Contact|About)\b)/i', '$1 - ', $value);
    }
}
