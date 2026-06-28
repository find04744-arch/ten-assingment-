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
        Schema::table('users', function (Blueprint $table) {
            $table->string('photo_url')->nullable()->after('email');
            $table->enum('role', ['user', 'creator', 'admin'])->default('user')->after('photo_url');
            $table->enum('subscription_status', ['free', 'premium'])->default('free')->after('role');
            $table->timestamp('subscription_expires_at')->nullable()->after('subscription_status');
            $table->string('google_id')->nullable()->unique()->after('subscription_expires_at');
            $table->text('bio')->nullable()->after('google_id');
            $table->integer('total_prompts')->default(0)->after('bio');
            $table->integer('total_copies')->default(0)->after('total_prompts');
            $table->integer('total_bookmarks')->default(0)->after('total_copies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'photo_url',
                'role',
                'subscription_status',
                'subscription_expires_at',
                'google_id',
                'bio',
                'total_prompts',
                'total_copies',
                'total_bookmarks',
            ]);
        });
    }
};
