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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();

            // Intro Section
            $table->string('intro_image_path')->nullable();
            $table->string('experience_years')->default('25+');
            $table->string('experience_title')->default('YEARS OF EXCELLENCE');
            $table->string('intro_subtitle')->default('Who We Are');
            $table->string('intro_title')->default('World-Class Apparel Manufacturing');
            $table->text('intro_description_1')->nullable();
            $table->text('intro_description_2')->nullable();
            $table->json('intro_features')->nullable(); // Array of strings

            // Mission/Vision/Values Section
            $table->string('mission_title')->default('Our Mission');
            $table->text('mission_description')->nullable();
            $table->string('vision_title')->default('Our Vision');
            $table->text('vision_description')->nullable();
            $table->string('values_title')->default('Core Values');
            $table->json('values_list')->nullable(); // Array of strings

            // Why Choose Us Section
            $table->string('why_choose_subtitle')->default('Why Partner With Us');
            $table->string('why_choose_title')->default('Strategic Partner in Fashion');
            $table->text('why_choose_description')->nullable();
            $table->json('why_choose_features')->nullable(); // Array of objects {title, description}

            // CTA Section
            $table->string('cta_title')->default('Looking for a Reliable Manufacturing Partner?');
            $table->string('cta_description')->default("Let's bring your clothing line to life with precision and care.");
            $table->string('cta_button_text')->default('Get a Quote');
            $table->string('cta_button_link')->default('#');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
