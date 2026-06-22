<?php

namespace Tests\Feature;

use App\Models\PortalUser;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PortalAuthenticationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('portal_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password_hash');
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();
        });
    }

    public function test_valid_hashed_credentials_open_the_portal(): void
    {
        PortalUser::create([
            'name' => 'Portal User',
            'email' => 'portal@example.com',
            'password_hash' => Hash::make('StrongPassword123!'),
            'is_active' => true,
        ]);

        $response = $this->post('/portal/login', [
            'email' => 'portal@example.com',
            'password' => 'StrongPassword123!',
        ]);

        $response->assertRedirect('/portal/dashboard');
        $this->assertTrue((bool) session('admin_authenticated'));
        $this->assertNotNull(session('admin_user_id'));
    }

    public function test_invalid_password_is_rejected(): void
    {
        PortalUser::create([
            'name' => 'Portal User',
            'email' => 'portal@example.com',
            'password_hash' => Hash::make('StrongPassword123!'),
            'is_active' => true,
        ]);

        $this->from('/portal/login')->post('/portal/login', [
            'email' => 'portal@example.com',
            'password' => 'WrongPassword123!',
        ])->assertRedirect('/portal/login')->assertSessionHas('error');

        $this->assertFalse((bool) session('admin_authenticated'));
    }
}
