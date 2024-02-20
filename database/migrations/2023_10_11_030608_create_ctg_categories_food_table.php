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
        Schema::create('ctg_categories_food', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('palabra_clave');
            $table->string('image_path');
            
            $table->timestamps();
            $table->boolean('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ctg_categories_food');
    }
};
