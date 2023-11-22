<?php

namespace Database\Seeders;
use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categories::create([
            'name' => 'Lacteos',
            'palabra_clave' => 'leche,queso,crema,mantequilla,yogurt',
            'image_path' => 'img'
        ]);

        Categories::create([
            'name' => 'Frutas',
            'palabra_clave' => 'mandarina,toronja,platano,fresa,cereza,manzana',
            'image_path' => 'img'

        ]);
        Categories::create([
            'name' => 'Verduras',
            'palabra_clave' => 'ajo,aguacate,apio,Albahaca,jitomate',
            'image_path' => 'img'

        ]);

        Categories::create([
            'name' => 'Abarrotes',
            'palabra_clave' => 'gelatina,aceite,huevo,azucar,cafe,te,',
            'image_path' => 'img'

        ]);
    }
}
