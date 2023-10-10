<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grammage;
class GrammageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grammage::create(['name' => '900ml']);
        Grammage::create(['name' => '450ml']);
        Grammage::create(['name' => 'Kilo']);
        Grammage::create(['name' => '125 g']);
        Grammage::create(['name' => 'Pieza']);
        Grammage::create(['name' => 'Litro']);
        Grammage::create(['name' => 'Bote']);
        Grammage::create(['name' => 'Caja']);
        Grammage::create(['name' => 'Frasco']);
        Grammage::create(['name' => 'Tetrapack']);
        Grammage::create(['name' => 'Paquete']);
        Grammage::create(['name' => 'Bolsa']);
        Grammage::create(['name' => 'Cubeta',]);
        Grammage::create(['name' => 'Botella']);
    }
}
