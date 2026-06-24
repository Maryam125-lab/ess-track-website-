<?php

namespace Tests\Feature;

use App\Models\PortalUser;
use App\Services\CmsStorage;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use ReflectionClass;
use Tests\TestCase;

class CmsCrudTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['cms.use_json_storage' => false, 'cms.database_schema_ready' => true]);
        $this->resetCmsStorageCache();
        $this->createTables();
        $this->actingAsPortalUser();
    }

    public function test_blog_crud_changes_public_blog_page(): void
    {
        $title = 'Automated Blog Visibility Check';

        $this->post('/portal/blog', [
            'title' => $title,
            'excerpt' => 'Visible blog excerpt.',
            'content' => 'Visible blog content body.',
            'image_url' => '/images/blog-test.jpg',
            'author' => 'ESS-Track Team',
            'status' => 'published',
            'published_at' => now()->format('Y-m-d H:i:s'),
        ])->assertRedirect('/portal/blog');

        $id = DB::table('blog_posts')->where('title', $title)->value('id');
        $this->assertNotNull($id);
        $this->get('/blog')->assertOk()->assertSee($title);

        $updatedTitle = 'Fresh Blog Title After Update';
        $this->put('/portal/blog/' . $id, [
            'title' => $updatedTitle,
            'excerpt' => 'Updated visible blog excerpt.',
            'content' => 'Updated visible blog content body.',
            'image_url' => '/images/blog-test-updated.jpg',
            'author' => 'ESS-Track Team',
            'status' => 'published',
            'published_at' => now()->format('Y-m-d H:i:s'),
            'regenerate_slug' => '1',
        ])->assertRedirect('/portal/blog');

        $this->get('/blog')->assertOk()->assertSee($updatedTitle)->assertDontSee($title);

        $this->delete('/portal/blog/' . $id)->assertRedirect('/portal/blog');
        $this->get('/blog')->assertOk()->assertDontSee($updatedTitle);
    }

    public function test_success_story_crud_changes_public_success_stories_page(): void
    {
        $title = 'Automated Success Story Check';

        $this->post('/portal/success-stories', [
            'title' => $title,
            'excerpt' => 'Story excerpt visible publicly.',
            'content' => 'Story content visible publicly.',
            'image_url' => '/images/story-test.jpg',
            'client_name' => 'Test Client',
            'industry' => 'Fleet',
            'status' => 'published',
            'sort_order' => 1,
        ])->assertRedirect('/portal/success-stories');

        $id = DB::table('success_stories')->where('title', $title)->value('id');
        $this->assertNotNull($id);
        $this->get('/success-stories')->assertOk()->assertSee($title);

        $updatedTitle = 'Fresh Story Title After Update';
        $this->put('/portal/success-stories/' . $id, [
            'title' => $updatedTitle,
            'excerpt' => 'Updated story excerpt visible publicly.',
            'content' => 'Updated story content visible publicly.',
            'image_url' => '/images/story-test-updated.jpg',
            'client_name' => 'Updated Test Client',
            'industry' => 'Fleet',
            'status' => 'published',
            'sort_order' => 1,
            'regenerate_slug' => '1',
        ])->assertRedirect('/portal/success-stories');

        $this->get('/success-stories')->assertOk()->assertSee($updatedTitle)->assertDontSee($title);

        $this->delete('/portal/success-stories/' . $id)->assertRedirect('/portal/success-stories');
        $this->get('/success-stories')->assertOk()->assertSee('Success Stories Coming Soon')->assertDontSee($updatedTitle);
    }

    public function test_promotion_crud_changes_services_page(): void
    {
        $title = 'Automated Services Promotion';
        $code = 'AUTO2026';

        $this->post('/portal/promotions', [
            'title' => $title,
            'description' => 'Promotion visible on services page.',
            'promo_code' => $code,
            'discount_type' => 'percent',
            'discount_value' => '5',
            'badge_text' => '5% OFF',
            'applies_to' => 'all',
            'show_on_services' => '1',
            'status' => 'active',
            'sort_order' => 1,
        ])->assertRedirect('/portal/promotions');

        $id = DB::table('promotions')->where('promo_code', $code)->value('id');
        $this->assertNotNull($id);
        $this->get('/services')->assertOk()->assertSee($title)->assertSee($code);

        $this->delete('/portal/promotions/' . $id)->assertRedirect('/portal/promotions');
        $this->get('/services')->assertOk()->assertDontSee($title)->assertDontSee($code);
    }

    public function test_package_builder_changes_public_services_page(): void
    {
        $packageName = 'Automated Fleet Test Package';

        $this->post('/portal/pages/services', [
            'packages_json' => json_encode([
                [
                    'type' => 'rental',
                    'badge' => 'Tested',
                    'name' => $packageName,
                    'price' => 'PKR 12,345',
                    'unit' => '/Total',
                    'popular' => true,
                    'breakdown' => [['Setup', 'PKR 12,345']],
                    'features' => ['Visible package feature'],
                ],
            ]),
            'addons_json' => json_encode([
                ['name' => 'Automated Add-on', 'price' => 'PKR 999', 'description' => 'Visible add-on'],
            ]),
            'custom_title' => 'Automated Custom Solution',
            'custom_items' => 'Automated dashboard, Automated reports',
            'custom_button' => 'Automated Quote',
        ])->assertSessionHas('success');

        $this->get('/services')
            ->assertOk()
            ->assertSee($packageName)
            ->assertSee('PKR 12,345')
            ->assertSee('Automated Add-on')
            ->assertSee('Automated Custom Solution');
    }

    public function test_global_page_content_changes_shared_public_navigation(): void
    {
        $navLabel = 'Automated Contact Label';

        $this->post('/portal/pages/global', [
            'nav_home' => 'Home',
            'nav_tracker' => 'Vehicle Tracker',
            'nav_packages' => 'Packages',
            'nav_about' => 'About Us',
            'nav_blog' => 'Blog',
            'nav_success_stories' => 'Success Stories',
            'nav_contact' => $navLabel,
            'footer_description' => 'Automated footer description.',
            'footer_pages_title' => 'Pages',
            'footer_packages_title' => 'Our Packages',
            'footer_contact_title' => 'Contact Info',
            'footer_rights_text' => 'All rights reserved.',
        ])->assertSessionHas('success');

        $this->get('/')
            ->assertOk()
            ->assertSee($navLabel)
            ->assertSee('Automated footer description.');
    }

    private function actingAsPortalUser(): void
    {
        $user = PortalUser::create([
            'name' => 'Portal User',
            'email' => 'portal@example.com',
            'password_hash' => Hash::make('StrongPassword123!'),
            'is_active' => true,
        ]);

        $this->withSession([
            'admin_authenticated' => true,
            'admin_user_id' => $user->id,
            'admin_email' => $user->email,
        ]);
    }

    private function createTables(): void
    {
        foreach (['portal_users', 'blog_posts', 'success_stories', 'promotions', 'cms_site_settings', 'cms_page_seo', 'cms_page_contents', 'analytics_page_views'] as $table) {
            Schema::dropIfExists($table);
        }

        Schema::create('portal_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password_hash');
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_page_seo', function (Blueprint $table) {
            $table->id();
            $table->string('page_key')->unique();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('keywords')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_key');
            $table->string('field_key');
            $table->string('label')->nullable();
            $table->longText('value')->nullable();
            $table->string('type')->default('text');
            $table->string('group')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->unique(['page_key', 'field_key']);
        });

        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('image_url')->nullable();
            $table->string('author')->default('ESS-Track Team');
            $table->string('status')->default('draft');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('success_stories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('image_url')->nullable();
            $table->string('client_name')->nullable();
            $table->string('industry')->nullable();
            $table->string('status')->default('draft');
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });

        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('promo_code', 50)->nullable();
            $table->string('discount_type', 30)->default('percent');
            $table->string('discount_value', 50)->nullable();
            $table->string('badge_text', 100)->nullable();
            $table->string('applies_to', 50)->default('all');
            $table->boolean('show_on_home')->default(true);
            $table->boolean('show_on_services')->default(true);
            $table->boolean('show_on_promo_modal')->default(true);
            $table->date('valid_from')->nullable();
            $table->date('valid_until')->nullable();
            $table->string('status', 20)->default('active');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
        Schema::create('analytics_page_views', function (Blueprint $table) {
            $table->id();
            $table->string('page_path');
            $table->string('page_title')->nullable();
            $table->string('referrer', 500)->nullable();
            $table->timestamp('viewed_at')->useCurrent();
        });
    }

    private function resetCmsStorageCache(): void
    {
        $reflection = new ReflectionClass(CmsStorage::class);
        foreach (['dbAvailable', 'jsonCache', 'tableCache'] as $property) {
            $prop = $reflection->getProperty($property);
            $prop->setAccessible(true);
            $prop->setValue(null, $property === 'tableCache' ? [] : null);
        }
    }
}
