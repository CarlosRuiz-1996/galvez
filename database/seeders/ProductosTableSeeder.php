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
            'descripcion' => 'CREMA BAJA EN GRASA',
            'grammage_id'=> 1,
            'presentation_id'=> 1,
            'brand_id' => 1, 
            'price'=> 50,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 50,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'CREMA DESLACTOSADA',
            'grammage_id'=> 2,
            'presentation_id'=> 1,
            'brand_id' => 1, 
            'price'=> 29,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 29,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'CREMA ENTERA',
            'grammage_id'=> 2,
            'presentation_id'=> 1,
            'brand_id' => 1, 
            'price'=> 28,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 28,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'CREMA ENTERA',
            'grammage_id'=> 1,
            'presentation_id'=> 1,
            'brand_id' => 1,
            'price'=> 52,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 52,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'GELATINA',
            'grammage_id'=> 4,
            'presentation_id'=> 2,
            'brand_id' => 2, 
            'price'=> 5,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 5,
            'stock'=> 100,
            'category_id'=> 4,
            
        ]);
        Product::create([
            'descripcion' => 'MANTEQUILLA',
            'grammage_id'=> 3,
            'presentation_id'=> 3,
            'brand_id' => 4,
            'price'=> 140,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 140,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'MANTEQUILLA',
            'grammage_id'=> 3,
            'presentation_id'=> 3,
            'brand_id' => 5, 
            'price'=> 140,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 140,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'BEBIDA DE LACTOBASILOS',
            'grammage_id'=> 5,
            'presentation_id'=> 4,
            'brand_id' => 6, 
            'price'=> 5,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 5,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'CREMA DE LECHE DE VACA',
            'grammage_id'=> 5,
            'presentation_id'=> 5,
            'brand_id' => 7, 
            'price'=> 46,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 46,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'HELADO',
            'grammage_id'=> 6,
            'presentation_id'=> 6,
            'brand_id' => 8, 
            'price'=> 48,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 48,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'MARGARINA',
            'grammage_id'=> 5,
            'presentation_id'=> 7,
            'brand_id' => 9, 
            'price'=> 69,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 69,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'QUESO PETIT DE SABORES',
            'grammage_id'=> 5,
            'presentation_id'=> 8,
            'brand_id' => 10, 
            'price'=> 4,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 4,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'QUESO FRESCO CANASTO',
            'grammage_id'=> 3,
            'presentation_id'=> 9,
            'brand_id' => 5, 
            'price'=> 98,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 98,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'QUESO PANELA',
            'grammage_id'=> 5,
            'presentation_id'=> 10,
            'brand_id' => 32, 
            'price'=> 254,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 254,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'QUESO OAXACA',
            'grammage_id'=> 3,
            'presentation_id'=> 11,
            'brand_id' => 11, 
            'price'=> 82,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 82,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'QUESO TIPO MANCHEGO',
            'grammage_id'=> 3,
            'presentation_id'=> 12,
            'brand_id' => 12, 
            'price'=> 140,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 140,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'QUESO COTTAGE LIGHT',
            'grammage_id'=> 7,
            'presentation_id'=> 13,
            'brand_id' => 13, 
            'price'=> 44,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 44,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'QUESO CREMA',
            'grammage_id'=> 8,
            'presentation_id'=> 14,
            'brand_id' => 14, 
            'price'=> 225,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 255,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'QUESO DOBLE CREMA',
            'grammage_id'=> 3,
            'presentation_id'=> 15,
            'brand_id' => 5, 
            'price'=> 71,
            'iva_id'=> 5, 
            'ieps_id'=> 6,
            'total'=> 90,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'QUESO AMARILLO TIPO AMERICANO',
            'grammage_id'=> 8,
            'presentation_id'=> 16,
            'brand_id' => 15,
            'price'=> 75,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 75,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'YOGURT VARIOS SABORES',
            'grammage_id'=> 6,
            'presentation_id'=> 17,
            'brand_id' => 16, 
            'price'=> 38,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 38,
            'stock'=> 100,
            'category_id'=> 1,
            
        ]);
        Product::create([
            'descripcion' => 'AGUACATE',
            'grammage_id'=> 3,
            'presentation_id'=> 3,
            'brand_id' => 27,
            'price'=> 65,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 65,
            'stock'=> 100,
            'category_id'=> 3,
            
        ]);
        Product::create([
            'descripcion' => 'AGUACATE HASS',
            'grammage_id'=> 3,
            'presentation_id'=> 3,
            'brand_id' => 27,
            'price'=> 37,
            'iva_id'=> 1, 
            'ieps_id'=> 4,
            'total'=> 40,
            'stock'=> 100,
            'category_id'=> 3,
            
        ]);
        Product::create([
            'descripcion' => 'AJO',
            'grammage_id'=> 3,
            'presentation_id'=> 3,
            'brand_id' => 27,
            'price'=> 40,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 40,
            'stock'=> 100,
            'category_id'=> 3,
            
        ]);
        Product::create([
            'descripcion' => 'Albahaca de primera calidad',
            'grammage_id'=> 3,
            'presentation_id'=> 3,
            'brand_id' => 27,
            'price'=> 28,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 28,
            'stock'=> 100,
            'category_id'=> 3,
            
        ]);
        Product::create([
            'descripcion' => 'APIO',
            'grammage_id'=> 3,
            'presentation_id'=> 3,
            'brand_id' => 27,
            'price'=> 10,
            'iva_id'=> 1, 
            'ieps_id'=>1 ,
            'total'=> 10,
            'stock'=> 100,
            'category_id'=> 3,
            
        ]);
        Product::create([
            'descripcion' => 'MANDARINA',
            'grammage_id'=> 3,
            'presentation_id'=> 3,
            'brand_id' => 27,
            'price'=> 12,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 13,
            'stock'=> 100,
            'category_id'=> 2,
            
        ]);
        Product::create([
            'descripcion' => 'Toronja de primera calidad',
            'grammage_id'=> 3,
            'presentation_id'=> 3,
            'brand_id' => 27,
            'price'=> 7,
            'iva_id'=> 1, 
            'ieps_id'=> 1,
            'total'=> 7,
            'stock'=> 100,
            'category_id'=> 2,
            
        ]);
    }
}
