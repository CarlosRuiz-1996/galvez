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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('cantidad');
            $table->string('gramaje');
            $table->foreignId('ctg_grammage_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('food_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
