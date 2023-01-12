<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    const STATES = [
        'New',
        'Accepted',
        'Canceled',
        'Finished'
    ];
}
