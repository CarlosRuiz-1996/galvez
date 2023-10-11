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
            $table->string('name');
            $table->text('descripcion');
            $table->unsignedBigInteger('ctg_grammage_id');
            $table->string('gramaje');
            $table->unsignedBigInteger('ctg_presentation_id');
            $table->unsignedBigInteger('ctg_brand_id'); //marca id
            $table->float('price');
            $table->unsignedBigInteger('iva_id');
            $table->unsignedBigInteger('ieps_id');
            $table->float('total');
            $table->integer('stock');
            $table->string('imagen_path');
            $table->unsignedBigInteger('ctg_category_id');
            $table->timestamps();
            $table->foreign('ctg_category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('ctg_grammage_id')->references('id')->on('grammages')->onDelete('cascade');
            $table->foreign('ctg_presentation_id')->references('id')->on('presentations')->onDelete('cascade');
            $table->foreign('ctg_brand_id')->references('id')->on('brands')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
};
