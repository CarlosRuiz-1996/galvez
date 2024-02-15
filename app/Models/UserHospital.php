<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHospital extends Model
{
    protected $table = 'user_hospital';
    use HasFactory;
    protected $fillable = [
        'hospital_id',
        'user_id',
    ];
}
