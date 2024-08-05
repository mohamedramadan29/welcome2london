<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('home_page_controlles', function (Blueprint $table) {
            $table->id();
            $table->string('hero_first_title');
            $table->string('hero_second_title');
            $table->string('hero_desc');
            $table->string('hero_phone');
            $table->string('hero_image1');
            $table->string('hero_image2');
            $table->string('hero_image3');
            $table->string('about_image');
            $table->string('about_title');
            $table->string('about_desc');
            $table->string('about_feature1');
            $table->string('about_feature2');
            $table->string('about_feature3');
            $table->string('about_feature4');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_page_controlles');
    }
};
