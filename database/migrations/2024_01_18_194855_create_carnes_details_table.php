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

        Schema::create('carnes_details', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(1);
            $table->float('gramaje_total')->nullable();
            $table->float('gramaje_virtual')->nullable();
            $table->foreignId('carnes_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ctg_carnes_id')->constrained()->onDelete('cascade')->onUpdate('cascade');//debe aceptar nulos
            //se agrego al final
            $table->foreignId('ctg_grammage_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            //asi lo meti desde sql// ALTER TABLE carnes_details ADD CONSTRAINT carnes_details_ctg_grammage_id_foreign FOREIGN KEY (ctg_grammage_id) REFERENCES ctg_grammages(id) ON DELETE CASCADE ON UPDATE CASCADE; 
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carnes_details');
    }
};
