<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('inquiries')) {
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
        }
    }

    public function down()
    {
        Schema::dropIfExists('inquiries');
    }
};
