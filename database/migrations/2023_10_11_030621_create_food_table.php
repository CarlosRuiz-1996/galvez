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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image_path');
            $table->unsignedBigInteger('ctg_presentation_food_id');
            $table->unsignedBigInteger('ctg_categories_food_id');

            $table->foreign('ctg_presentation_food_id')->references('id')->on('ctg_presentation_food')->onDelete('cascade');
            $table->foreign('ctg_categories_food_id')->references('id')->on('ctg_categories_food')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
