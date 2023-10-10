<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create(['name' => 'ALPURA']);
        Brand::create(['name' => 'LALA YOM']);
        Brand::create(['name' => 'Kilo']);
        Brand::create(['name' => 'GLORIA']);
        Brand::create(['name' => 'CHILCHOTA']);
        Brand::create(['name' => 'YAKULT']);
        Brand::create(['name' => 'LALA']);
        Brand::create(['name' => 'HOLANDA']);
        Brand::create(['name' => 'IBERIA']);
        Brand::create(['name' => 'DANONINO 42G']);
        Brand::create(['name' => 'ARRIERO']);
        Brand::create(['name' => 'NOCHE BUENA']);
        Brand::create(['name' => 'LYNCOT']);
        Brand::create(['name' => 'PHILADELPHIA']);
        Brand::create(['name' => 'CASTEL´S']);
        Brand::create(['name' => 'YOPLAIT']);
        Brand::create(['name' => 'SELLO DE ORO']);
        Brand::create(['name' => 'CASTEL']);
        Brand::create(['name' => 'EXCELSIOR']);
        Brand::create(['name' => 'SAN JOSE']);
        Brand::create(['name' => 'LOS VOLCANES']);
        Brand::create(['name' => 'YAKULT 80ml']);
        Brand::create(['name' => 'BON SWISS']);
        Brand::create(['name' => 'LA VILLITA']);
        Brand::create(['name' => 'KRAFT']);
        Brand::create(['name' => 'FUD']);
        Brand::create(['name' => 'PRIMERA CALIDAD']);
        Brand::create(['name' => 'CAPULLO']);
        Brand::create(['name' => 'PATRONA']);
        Brand::create(['name' => 'MAZOLA']);
        Brand::create(['name' => 'YBARRA']);
        Brand::create(['name' => 'LA FRANJA']);

    }
}
