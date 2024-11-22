<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Pharmacy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PharmacySeeder extends Seeder
{
    public function run()
    {
        // Find or create the city of Harare
        $harare = City::firstOrCreate(['name' => 'Harare']);

        // List of pharmacies in Harare
        $pharmacies = [
            ['name' => 'Avondale Pharmacy', 'address' => 'Avondale Shopping Centre'],
            ['name' => 'Parirenyatwa Pharmacy', 'address' => 'Parirenyatwa Group of Hospitals'],
            ['name' => 'Westend Pharmacy', 'address' => '1 Kwame Nkrumah Ave'],
            ['name' => 'Greenwood Pharmacy', 'address' => 'Borrowdale Village'],
            ['name' => 'Medicure Pharmacy', 'address' => 'Joina City'],
        ];

        // Seed pharmacies in Harare
        foreach ($pharmacies as $pharmacy) {
            Pharmacy::create([
                'name' => $pharmacy['name'],
                'address' => $pharmacy['address'],
                'city_id' => $harare->id,
            ]);
        }
    }
}
