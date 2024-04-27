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
        Schema::create('compras_solicitudes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

            //usuario que realiza la compra o registro
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

            $table->integer('cantidad');
            $table->integer('urgencia')->default(1); //1- aun hay productos para mandar el minimo / 0-no alcanza a surtir el minmimo
            $table->text('mensaje')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras_solicitudes');
    }
};
