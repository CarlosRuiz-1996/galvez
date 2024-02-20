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
        //esta tabla es con fines de arquitectura y funcionamiento de los catalogos. 
        //para poder ahorrar codigo html
        Schema::disableForeignKeyConstraints();
        Schema::create('catalogos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('route')->nullable();
            $table->string('model_type')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogos');
    }
};
