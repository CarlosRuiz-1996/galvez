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
        Schema::disableForeignKeyConstraints();

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->unsignedBigInteger('grammage_id');
            $table->unsignedBigInteger('presentation_id');
            $table->unsignedBigInteger('brand_id'); //marca id
            $table->float('price');
            $table->unsignedBigInteger('iva_id');
            $table->unsignedBigInteger('ieps_id');
            $table->float('total');
            $table->integer('stock');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('grammage_id')->references('id')->on('grammages')->onDelete('cascade');
            $table->foreign('presentation_id')->references('id')->on('presentations')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('iva_id')->references('id')->on('iva')->onDelete('cascade');
            $table->foreign('ieps_id')->references('id')->on('iep')->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
