<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Product::create([ 
            'name' => 'CREMA BAJA EN GRASA',
            'ctg_grammage_id'=> 1,
            'ctg_presentation_id'=> 1,
            'ctg_brand_id' => 1, 
            'price'=> 50,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 50,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'CREMA DESLACTOSADA',
            'ctg_grammage_id'=> 2,
            'ctg_presentation_id'=> 1,
            'ctg_brand_id' => 1, 
            'price'=> 29,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 29,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'CREMA ENTERA',
            'ctg_grammage_id'=> 2,
            'ctg_presentation_id'=> 1,
            'ctg_brand_id' => 1, 
            'price'=> 28,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 28,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'CREMA ENTERA',
            'ctg_grammage_id'=> 1,
            'ctg_presentation_id'=> 1,
            'ctg_brand_id' => 1,
            'price'=> 52,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 52,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'GELATINA',
            'ctg_grammage_id'=> 4,
            'ctg_presentation_id'=> 2,
            'ctg_brand_id' => 2, 
            'price'=> 5,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 5,
            'stock'=> 100,
            'ctg_category_id'=> 4,
            
        ]);
        Product::create([
            'name' => 'MANTEQUILLA',
            'ctg_grammage_id'=> 3,
            'ctg_presentation_id'=> 3,
            'ctg_brand_id' => 4,
            'price'=> 140,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 140,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'MANTEQUILLA',
            'ctg_grammage_id'=> 3,
            'ctg_presentation_id'=> 3,
            'ctg_brand_id' => 5, 
            'price'=> 140,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 140,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'BEBIDA DE LACTOBASILOS',
            'ctg_grammage_id'=> 5,
            'ctg_presentation_id'=> 4,
            'ctg_brand_id' => 6, 
            'price'=> 5,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 5,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'CREMA DE LECHE DE VACA',
            'ctg_grammage_id'=> 5,
            'ctg_presentation_id'=> 5,
            'ctg_brand_id' => 7, 
            'price'=> 46,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 46,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'HELADO',
            'ctg_grammage_id'=> 6,
            'ctg_presentation_id'=> 6,
            'ctg_brand_id' => 8, 
            'price'=> 48,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 48,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'MARGARINA',
            'ctg_grammage_id'=> 5,
            'ctg_presentation_id'=> 7,
            'ctg_brand_id' => 9, 
            'price'=> 69,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 69,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'QUESO PETIT DE SABORES',
            'ctg_grammage_id'=> 5,
            'ctg_presentation_id'=> 8,
            'ctg_brand_id' => 10, 
            'price'=> 4,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 4,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'QUESO FRESCO CANASTO',
            'ctg_grammage_id'=> 3,
            'ctg_presentation_id'=> 9,
            'ctg_brand_id' => 5, 
            'price'=> 98,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 98,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'QUESO PANELA',
            'ctg_grammage_id'=> 5,
            'ctg_presentation_id'=> 10,
            'ctg_brand_id' => 32, 
            'price'=> 254,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 254,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'QUESO OAXACA',
            'ctg_grammage_id'=> 3,
            'ctg_presentation_id'=> 11,
            'ctg_brand_id' => 11, 
            'price'=> 82,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 82,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'QUESO TIPO MANCHEGO',
            'ctg_grammage_id'=> 3,
            'ctg_presentation_id'=> 12,
            'ctg_brand_id' => 12, 
            'price'=> 140,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 140,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'QUESO COTTAGE LIGHT',
            'ctg_grammage_id'=> 7,
            'ctg_presentation_id'=> 13,
            'ctg_brand_id' => 13, 
            'price'=> 44,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 44,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'QUESO CREMA',
            'ctg_grammage_id'=> 8,
            'ctg_presentation_id'=> 14,
            'ctg_brand_id' => 14, 
            'price'=> 225,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 255,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'QUESO DOBLE CREMA',
            'ctg_grammage_id'=> 3,
            'ctg_presentation_id'=> 15,
            'ctg_brand_id' => 5, 
            'price'=> 71,
            'iva_id'=> 5, 
            'ieps_id'=> 6,
            'total'=> 90,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'QUESO AMARILLO TIPO AMERICANO',
            'ctg_grammage_id'=> 8,
            'ctg_presentation_id'=> 16,
            'ctg_brand_id' => 15,
            'price'=> 75,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 75,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'YOGURT VARIOS SABORES',
            'ctg_grammage_id'=> 6,
            'ctg_presentation_id'=> 17,
            'ctg_brand_id' => 16, 
            'price'=> 38,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 38,
            'stock'=> 100,
            'ctg_category_id'=> 1,
            
        ]);
        Product::create([
            'name' => 'AGUACATE',
            'ctg_grammage_id'=> 3,
            'ctg_presentation_id'=> 3,
            'ctg_brand_id' => 27,
            'price'=> 65,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 65,
            'stock'=> 100,
            'ctg_category_id'=> 3,
            
        ]);
        Product::create([
            'name' => 'AGUACATE HASS',
            'ctg_grammage_id'=> 3,
            'ctg_presentation_id'=> 3,
            'ctg_brand_id' => 27,
            'price'=> 37,
            'iva_id'=> 1, 
            'ieps_id'=> 4,
            'total'=> 40,
            'stock'=> 100,
            'ctg_category_id'=> 3,
            
        ]);
        Product::create([
            'name' => 'AJO',
            'ctg_grammage_id'=> 3,
            'ctg_presentation_id'=> 3,
            'ctg_brand_id' => 27,
            'price'=> 40,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 40,
            'stock'=> 100,
            'ctg_category_id'=> 3,
            
        ]);
        Product::create([
            'name' => 'Albahaca de primera calidad',
            'ctg_grammage_id'=> 3,
            'ctg_presentation_id'=> 3,
            'ctg_brand_id' => 27,
            'price'=> 28,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 28,
            'stock'=> 100,
            'ctg_category_id'=> 3,
            
        ]);
        Product::create([
            'name' => 'APIO',
            'ctg_grammage_id'=> 3,
            'ctg_presentation_id'=> 3,
            'ctg_brand_id' => 27,
            'price'=> 10,
            'iva_id'=> 1, 
            'ieps_id'=>1 ,
            'total'=> 10,
            'stock'=> 100,
            'ctg_category_id'=> 3,
            
        ]);
        Product::create([
            'name' => 'MANDARINA',
            'ctg_grammage_id'=> 3,
            'ctg_presentation_id'=> 3,
            'ctg_brand_id' => 27,
            'price'=> 12,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 13,
            'stock'=> 100,
            'ctg_category_id'=> 2,
            
        ]);
        Product::create([
            'name' => 'Toronja de primera calidad',
            'ctg_grammage_id'=> 3,
            'ctg_presentation_id'=> 3,
            'ctg_brand_id' => 27,
            'price'=> 7,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 7,
            'stock'=> 100,
            'ctg_category_id'=> 2,
            
        ]);
    }
}
