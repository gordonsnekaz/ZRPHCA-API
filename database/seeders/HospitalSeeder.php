<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    public function run()
    {
        $harare = City::firstOrCreate(['name' => 'Harare']);

        $hospitals = [
            ['name' => 'Parirenyatwa Hospital', 'address' => 'Parirenyatwa Group of Hospitals'],
            ['name' => 'Harare Central Hospital', 'address' => 'Southerton, Harare'],
            ['name' => 'Avenues Clinic', 'address' => 'Baines Ave, Harare'],
            ['name' => 'West End Hospital', 'address' => 'Bishop Gaul Ave, Harare'],
            ['name' => 'Belvedere Medical Centre', 'address' => 'Belvedere, Harare'],
        ];

        foreach ($hospitals as $hospital) {
            Hospital::create([
                'name' => $hospital['name'],
                'address' => $hospital['address'],
                'city_id' => $harare->id,
            ]);
        }
    }
}
