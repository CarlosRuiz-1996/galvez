<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ctg_carne;
class CtgCarne extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //POLLO
        ctg_carne::create([
            'name' => 'Pechuga entera con piel y hueso',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Pechuga entera sin piel sin hueso',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Milanesa de pollo 100gr',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Milanesa de pollo 120gr',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Milanesa de pollo 150Gr',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Milanesa de pollo 160gr',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Milanesa de pollo 180gr',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Alas',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Pierna con piel',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Pierna sin piel',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Muslo con piel',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Muslo sin piel',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Pierna con muslo con piel ',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Pierna con muslo sin piel',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Pechuga mariposa',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Fajitas',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Molida',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Medallones',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Nugget',
            'ctg_tipo_carnes_id'=>1
        ]);
        ctg_carne::create([
            'name' => 'Retazo (huacal-rabadilla)',
            'ctg_tipo_carnes_id'=>1
        ]);


         //RES
        ctg_carne::create([
            'name' => 'Molida 80/20',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Molida 90/10',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Molida magra',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Pulpa',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Chambarete',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Falda',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Panza',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Hueso',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Cuete entero',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Costilla roast beef',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Ryb eye',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'New York',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Filete caña',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Arrachera natural',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Arrachera marinada',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Cecina natural',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Suadero',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Falda entera 500gr aprox',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Bistec picado',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Bistec de 120 gr',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Bistec de 150gr',
            'ctg_tipo_carnes_id'=>2
        ]);
        ctg_carne::create([
            'name' => 'Bistec de 180gr',
            'ctg_tipo_carnes_id'=>2
        ]);



         //CERDO
         ctg_carne::create([
            'name' => 'Lomo trozo',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Caña de lomo',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Pierna trozo',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Pierna entera sin hueso',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Chuleta natural',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Chuleta ahumada',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Bistec',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Longaniza',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Bistec enchilado',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Molida',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Chicharron delgado',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Chicharron carnudo',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Prensado',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Cabeza',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Manteca',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Falda',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Costilla',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Chorizo',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Codillo',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Oreja',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Buche',
            'ctg_tipo_carnes_id'=>3
        ]);
        ctg_carne::create([
            'name' => 'Cuero delgado',
            'ctg_tipo_carnes_id'=>3
        ]);
    }
}
