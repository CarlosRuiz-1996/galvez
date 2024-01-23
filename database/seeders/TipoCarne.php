<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ctg_tipo_carne;
class TipoCarne extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ctg_tipo_carne::create([
            'name' => 'Pollo',
        ]);
        ctg_tipo_carne::create([
            'name' => 'Res',
        ]);
        ctg_tipo_carne::create([
            'name' => 'Cerdo',
        ]);
    }
}
