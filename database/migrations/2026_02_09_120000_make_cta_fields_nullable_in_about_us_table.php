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
        Schema::table('about_us', function (Blueprint $table) {
            $table->string('cta_description')->nullable()->change();
            $table->string('cta_button_text')->nullable()->change();
            $table->string('cta_button_link')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->string('cta_description')->nullable(false)->default("Let's bring your clothing line to life with precision and care.")->change();
            $table->string('cta_button_text')->nullable(false)->default('Get a Quote')->change();
            $table->string('cta_button_link')->nullable(false)->default('#')->change();
        });
    }
};
