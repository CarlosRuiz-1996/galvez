<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carnes extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo','catidad','grasa','hueso','bisteck'
    ];

}
