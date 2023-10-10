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
            'palabra_clave' => 'leche,queso,crema,mantequilla,yogurt'
        ]);

        Categories::create([
            'name' => 'Frutas',
            'palabra_clave' => 'mandarina,toronja,platano,fresa,cereza,manzana'
        ]);
        Categories::create([
            'name' => 'Verduras',
            'palabra_clave' => 'ajo,aguacate,apio,Albahaca,jitomate'
        ]);

        Categories::create([
            'name' => 'Abarrotes',
            'palabra_clave' => 'gelatina,aceite,huevo,azucar,cafe,te,'
        ]);
    }
}
