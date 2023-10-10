<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Iva;

class IvaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Iva::create(['name' => '0']);
        Iva::create(['name' => '1']);
        Iva::create(['name' => '5']);

        Iva::create(['name' => '6']);

        Iva::create(['name' => '12']);
        Iva::create(['name' => '13']);
        Iva::create(['name' => '14']);
        Iva::create(['name' => '21']);
        Iva::create(['name' => '22']);
        Iva::create(['name' => '62']);
    }
}
