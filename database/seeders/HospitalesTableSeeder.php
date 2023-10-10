<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hospital;

class HospitalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // for ($i = 1; $i <= 20; $i++) {

        //     Hospital::create([
        //         'name' => 'Hospital ' . $i,
        //         'address' => 'Avenida ' . $i,
        //         'phone' => '555-555-5555',
        //         'email' => 'hospital' . $i . '@example.com',
        //         'image_path' => 'imagen' . $i . '.png',
        //         'contact_name' => 'Contacto ' . $i,
        //         'contact_phone' => '111-111-1111',
        //         'contact_email' => 'contacto' . $i . '@example.com',
        //     ]);
        // }

        Hospital::create([
            'name' => 'Hospital 20 de mayo',
            'address' => 'Avenida 20 de mayo',
            'phone' => '555-555-5555',
            'email' => 'hospital20demayo' . '@example.com',
            'image_path' => 'imagen' . '.png',
            'contact_name' => 'Contacto ',
            'contact_phone' => '111-111-1111',
            'contact_email' => 'contacto' . '@example.com',
        ]);
        Hospital::create([
            'name' => 'Hospital san angele',
            'address' => 'Avenida angele',
            'phone' => '555-555-5555',
            'email' => 'angele' . '@example.com',
            'image_path' => 'imagen' . '.png',
            'contact_name' => 'Contacto ',
            'contact_phone' => '111-111-1111',
            'contact_email' => 'contacto' . '@example.com',
        ]);
        Hospital::create([
            'name' => 'Hospital ABC',
            'address' => 'Avenida ABC',
            'phone' => '555-555-5555',
            'email' => 'abc' . '@example.com',
            'image_path' => 'imagen' . '.png',
            'contact_name' => 'Contacto ',
            'contact_phone' => '111-111-1111',
            'contact_email' => 'contacto' . '@example.com',
        ]);
        Hospital::create([
            'name' => 'Hospital Homeopatico',
            'address' => 'Avenida Homeopatico',
            'phone' => '555-555-5555',
            'email' => 'Homeopatico' . '@example.com',
            'image_path' => 'imagen' . '.png',
            'contact_name' => 'Contacto ',
            'contact_phone' => '111-111-1111',
            'contact_email' => 'contacto' . '@example.com',
        ]);
        Hospital::create([
            'name' => 'Hospital la raza',
            'address' => 'Avenida ',
            'phone' => '555-555-5555',
            'email' => 'raza' . '@example.com',
            'image_path' => 'imagen' . '.png',
            'contact_name' => 'Contacto ',
            'contact_phone' => '111-111-1111',
            'contact_email' => 'contacto' . '@example.com',
        ]);
        Hospital::create([
            'name' => 'Hospital san angel pedregal',
            'address' => 'Avenida ',
            'phone' => '555-555-5555',
            'email' => 'pedregal' . '@example.com',
            'image_path' => 'imagen' . '.png',
            'contact_name' => 'Contacto ',
            'contact_phone' => '111-111-1111',
            'contact_email' => 'contacto' . '@example.com',
        ]);
    }
}
