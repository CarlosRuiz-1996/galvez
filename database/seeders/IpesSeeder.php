<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ieps;
class IpesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ieps::create(['name' => '0']);
        Ieps::create(['name' => '1']);
        Ieps::create(['name' => '2']);
        Ieps::create(['name' => '3']);
        Ieps::create(['name' => '6']);
        Ieps::create(['name' => '7']);

        Ieps::create(['name' => '11']);
        Ieps::create(['name' => '12']);
        Ieps::create(['name' => '33']);
       
    }
}
