<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cms_page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_key');
            $table->string('field_key');
            $table->string('label');
            $table->longText('value')->nullable();
            $table->string('type')->default('text');
            $table->string('group')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['page_key', 'field_key']);
            $table->index('page_key');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cms_page_contents');
    }
};
