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
        Schema::table('contact_infos', function (Blueprint $table) {
            // Form Section
            $table->string('form_title')->nullable()->default('Contact Form');
            $table->text('form_description')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('facebook_url')->nullable();

            // Contact Section Main
            $table->string('contact_section_title')->nullable()->default('CONTACT US');
            $table->string('contact_section_heading')->nullable()->default('Get In Touch!');
            $table->text('contact_section_description')->nullable();

            // Head Office (Existing columns: phone, email, address)
            $table->string('head_office_title')->nullable()->default('Head Office');

            // Branch Office
            $table->string('branch_office_title')->nullable()->default('Branch Office');
            $table->text('branch_office_address')->nullable();
            $table->string('branch_office_phone')->nullable();
            $table->string('branch_office_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_infos', function (Blueprint $table) {
            $table->dropColumn([
                'form_title',
                'form_description',
                'twitter_url',
                'facebook_url',
                'contact_section_title',
                'contact_section_heading',
                'contact_section_description',
                'head_office_title',
                'branch_office_title',
                'branch_office_address',
                'branch_office_phone',
                'branch_office_email',
            ]);
        });
    }
};
