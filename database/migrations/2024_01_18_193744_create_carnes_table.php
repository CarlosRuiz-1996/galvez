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

        Schema::create('carnes', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(1);
            $table->float('gramaje_total')->nullable();
            $table->float('gramaje_virtual')->nullable();
            $table->foreignId('ctg_grammage_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ctg_tipo_carnes_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carnes');
    }
};
