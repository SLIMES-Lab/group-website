<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('subtitle');
            $table->string('slug');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->mediumText('description');
            $table->string('image');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->date('publish_date');
            $table->boolean('is_draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
