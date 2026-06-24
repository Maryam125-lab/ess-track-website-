<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PublicFormsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->createTables();
    }

    public function test_contact_inquiry_flow_saves_to_database(): void
    {
        $phone = '03001234567';
        $this->verifyPhone($phone);

        $this->postJson('/api/inquiries', [
            'first_name' => 'Maryam',
            'last_name' => 'Test',
            'email' => 'maryam@example.com',
            'phone' => $phone,
            'vehicle_type' => 'Car / Sedan',
            'interested_package' => 'Gold Package',
            'message' => 'Please call me back.',
        ])->assertOk()->assertJson(['success' => true]);

        $this->assertDatabaseHas('inquiries', [
            'first_name' => 'Maryam',
            'email' => 'maryam@example.com',
            'phone_number' => $phone,
            'interested_package' => 'Gold Package',
        ]);
    }

    public function test_service_order_flow_saves_to_database(): void
    {
        $phone = '03007654321';
        $this->verifyPhone($phone);

        $this->postJson('/api/inquiries', [
            'name' => 'Order Customer',
            'email' => 'order@example.com',
            'mobile' => $phone,
            'vehicle_no' => 'ABC-123',
            'v_type' => 'Car / Sedan',
            'pkg_description' => 'Gold Package',
            'pkg_rate' => '18500',
            'pkg_price' => '18500',
            'res_address' => 'Test residential address',
            'message' => 'Book this package.',
        ])->assertOk()->assertJson(['success' => true]);

        $this->assertDatabaseHas('service_orders', [
            'customer_name' => 'Order Customer',
            'email' => 'order@example.com',
            'phone' => $phone,
            'vehicle_no' => 'ABC-123',
            'interested_package' => 'Gold Package',
        ]);
    }

    public function test_unverified_phone_is_rejected(): void
    {
        $this->postJson('/api/inquiries', [
            'first_name' => 'No OTP',
            'email' => 'no-otp@example.com',
            'phone' => '03001111111',
            'message' => 'This should fail.',
        ])->assertStatus(422)->assertJson(['success' => false]);

        $this->assertSame(0, DB::table('inquiries')->count());
    }

    private function verifyPhone(string $phone): void
    {
        $this->postJson('/api/send-otp', ['phone' => $phone])->assertOk();
        $this->postJson('/api/verify-otp', ['phone' => $phone, 'otp' => '1234'])->assertOk();
    }

    private function createTables(): void
    {
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('service_orders');

        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number', 30)->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('interested_package')->nullable();
            $table->text('message')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('email');
            $table->string('phone', 20);
            $table->string('vehicle_no', 50)->nullable();
            $table->string('vehicle_type', 50)->nullable();
            $table->string('interested_package', 100)->default('Not Sure');
            $table->string('package_rate', 50)->nullable();
            $table->string('package_price', 50)->nullable();
            $table->text('residential_address')->nullable();
            $table->text('commercial_address')->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('home_phone', 30)->nullable();
            $table->string('office_phone', 30)->nullable();
            $table->text('message')->nullable();
            $table->longText('raw_payload')->nullable();
            $table->string('status', 30)->default('new');
            $table->timestamp('created_at')->useCurrent();
        });
    }
}
