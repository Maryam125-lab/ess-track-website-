<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('service_orders')) {
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

    public function down()
    {
        Schema::dropIfExists('service_orders');
    }
};
