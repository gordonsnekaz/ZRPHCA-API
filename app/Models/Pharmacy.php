<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;
    
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    protected $fillable = [
        'name',      // Name of the pharmacy
        'address',   // Address of the pharmacy
        'city_id',   // Foreign key for the city
    ];
}
