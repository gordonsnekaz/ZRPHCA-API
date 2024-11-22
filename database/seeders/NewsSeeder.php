<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        News::create([
            'title' => 'New Vaccine Developed for Malaria',
            'description' => 'A new vaccine for malaria has been developed and tested successfully...',
            'symptoms' => 'Fever, chills, headache, nausea, vomiting...',
            'cure' => 'The new vaccine targets the malaria parasite...',
            'effects' => 'The vaccine has shown a 90% effectiveness rate in trials...',
        ]);

        News::create([
            'title' => 'New Treatments for Chronic Pain',
            'description' => 'Researchers have developed new treatments for managing chronic pain...',
            'symptoms' => 'Constant aching, discomfort, fatigue...',
            'cure' => 'The treatment involves a combination of physical therapy and medication...',
            'effects' => 'The treatment has reduced symptoms in 70% of patients...',
        ]);

        // Add more sample records as needed
    }
}
