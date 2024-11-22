<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function pharmacies()
    {
        return $this->hasMany(Pharmacy::class);
    }
    public function hospitals()
    {
        return $this->hasMany(Hospital::class);
    }
}
