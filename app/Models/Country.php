<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seazon;

class Country extends Model
{
    use HasFactory;
    public function seazon (){
        return $this->belongsTo(Seazon::class, 'seazon_id', 'id');
    }
    
}
