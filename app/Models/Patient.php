<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Add all the fields you want in the Patient model
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'email',
        'phone_number',
        'address',
        'blood_type',
        'emergency_contact',
        'id_number',
        'user_id',
        'created_at',
        'updated_at',
    ];
}
