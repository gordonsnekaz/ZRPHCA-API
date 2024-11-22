<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'diagnosed_by',
        'diagnosis_date',
        'diagnosis',
        'symptoms',
        'prescribed_medication',
        'notes',
    ];

    // Relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
