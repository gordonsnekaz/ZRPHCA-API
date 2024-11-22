<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Harare', 'Bulawayo', 'Chitungwiza', 'Mutare', 'Gweru',
            'Kwekwe', 'Kadoma', 'Masvingo', 'Chinhoyi', 'Marondera',
            'Norton', 'Chegutu', 'Victoria Falls', 'Hwange', 'Beitbridge',
            'Zvishavane', 'Rusape', 'Karoi', 'Bindura', 'Gwanda',
            'Chipinge', 'Shurugwi', 'Redcliff', 'Plumtree', 'Chiredzi'
        ];

        foreach ($cities as $city) {
            City::create(['name' => $city]);
        }
    }
}
