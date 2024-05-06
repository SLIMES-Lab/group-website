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
        Schema::create('homepage', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->string('subheading');
            $table->json('topics');
            $table->integer('papers');
            $table->integer('citations');
            $table->integer('group_members');
            $table->string('john_image');
            $table->mediumText('john_details');
            $table->string('seo_title')->default('Explore our research which includes several aspects of materials science');
            $table->string('seo_description')->default('We are a computational group pioneering material simulations and next-gen electronic property explorations.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage');
    }
};
