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
        Schema::create('aboutpage', function (Blueprint $table) {
            $table->id();
            $table->mediumText('description');
            $table->string('group_photo');
            $table->string('seo_title')->default('Know about our group and background of our research.');
            $table->string('seo_description')->default('We employ advanced computational modelling and simulation to predict materials properties and discover new materials for next generation technological applications.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aboutpage');
    }
};
