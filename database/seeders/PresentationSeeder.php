<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Presentation;
class PresentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Presentation::create(['name' => 'Bote']);
        Presentation::create(['name' => 'Pieza']);
        Presentation::create(['name' => 'Kilo']);
        Presentation::create(['name' => 'Frasco con 80ml']);
        Presentation::create(['name' => 'Bote sellado cont. Net. 900ml']);
        Presentation::create(['name' => 'Envase de cartón cont. Neto 1 Lt ']);
        Presentation::create(['name' => 'Barra de 1kg de margarina sin sal y sin colesterol ']);
        Presentation::create(['name' => 'Vaso con 45gs']);
        Presentation::create(['name' => 'Barra de aproximadamente 4 kg imitación de queso tipo fresco']);
        Presentation::create(['name' => 'Pieza de aprox. 2.5kg']);
        Presentation::create(['name' => 'Peso aproximado 3.500kg']);
        Presentation::create(['name' => 'Pieza de 4kg aprox. ']);
        Presentation::create(['name' => 'Pieza de 360 grs',]);
        Presentation::create(['name' => 'Caja de 1.900 kg']);
        Presentation::create(['name' => 'C Tipo Philadelphia, El Ciervo, Caperucita Roja o de calidad equivalente o superior.']);
        Presentation::create(['name' => 'Caja de 1.800 kg con 100 reb. De 18 g cada una']);
        Presentation::create(['name' => 'Envase de plástico con 1lt']);
        Presentation::create(['name' => 'Envase de plástico con 145 Grs']);
        Presentation::create(['name' => '450 ML']);
        Presentation::create(['name' => 'Litro']);
        Presentation::create(['name' => '1.800 KG']);
        Presentation::create(['name' => '1.900 KG']);
        Presentation::create(['name' => '900 ml']);
        Presentation::create(['name' => '450 ml']);
        Presentation::create(['name' => '900 ml']);
        Presentation::create(['name' => '125 g']);
        Presentation::create(['name' => '80 ml']);
        Presentation::create(['name' => '800 g']);
        Presentation::create(['name' => '400 g']);
        Presentation::create(['name' => '300 g']);
        Presentation::create(['name' => '190 g']);
        Presentation::create(['name' => '145 g']);
        Presentation::create(['name' => '220 ml']);
        Presentation::create(['name' => '4 Litros']);
        Presentation::create(['name' => 'Aceite de canola envasado en lata de spray de 170 g']);
        Presentation::create(['name' => 'Botella plástico contenido de 905 ml de aceite 100% puro de canola']);
        Presentation::create(['name' => 'Caja']);
        Presentation::create(['name' => '765 ml']);
        Presentation::create(['name' => 'Frasco de metal con un contenido de 946 ml ']);
        Presentation::create(['name' => 'Frasco 946ml']);
    }
}
