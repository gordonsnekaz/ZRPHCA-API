<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Report::create([
            'patient_id' => 1,
            'diagnosed_by' => "ZRPHCA Bot",
            'diagnosis' => "Flue",
            'diagnosis_date' => now()->subDays(10),
            'symptoms' => 'Fever, headache, and sore throat',
            'prescribed_medication' => 'Paracetamol and ibuprofen',
            'notes' => 'Patient advised to rest and stay hydrated.',
        ]);

        Report::create([
            'patient_id' => 1,
            'diagnosed_by' => "ZRPHCA Bot",
            'diagnosis' => "Flue",
            'diagnosis_date' => now()->subDays(5),
            'symptoms' => 'Shortness of breath and chest pain',
            'prescribed_medication' => 'Inhaler and aspirin',
            'notes' => 'Follow-up required in one week.',
        ]);
    }
}
