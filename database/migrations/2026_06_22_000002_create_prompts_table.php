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
        Schema::create('prompts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->longText('content');
            $table->string('category');
            $table->string('ai_tool');
            $table->json('tags')->nullable();
            $table->enum('difficulty_level', ['beginner', 'intermediate', 'pro'])->default('beginner');
            $table->string('thumbnail_image')->nullable();
            $table->enum('visibility', ['public', 'private'])->default('public');
            $table->integer('copy_count')->default(0);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->index(['status', 'visibility']);
            $table->index('user_id');
            $table->index('category');
            $table->index('ai_tool');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prompts');
    }
};
