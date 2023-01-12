<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hotel;
use App\Models\Country;

class Hotel extends Model
{
    use HasFactory;
    public function country (){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
