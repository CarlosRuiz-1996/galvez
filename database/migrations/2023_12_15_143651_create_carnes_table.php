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
        Schema::create('carnes', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo');
            $table->integer('cantidad');
            $table->integer('grasa')->nullable();
            $table->integer('hueso')->nullable();
            $table->integer('bisteck')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carnes');
    }
};
