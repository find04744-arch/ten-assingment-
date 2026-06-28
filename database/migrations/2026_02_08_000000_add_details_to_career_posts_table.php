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
        Schema::table('career_posts', function (Blueprint $table) {
            $table->string('category')->nullable()->after('title');
            $table->string('type')->default('Full Time')->after('category');
            $table->string('experience')->nullable()->after('type');
            $table->string('salary')->nullable()->after('experience');
            $table->date('deadline')->nullable()->after('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('career_posts', function (Blueprint $table) {
            $table->dropColumn(['category', 'type', 'experience', 'salary', 'deadline']);
        });
    }
};
