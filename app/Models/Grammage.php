<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grammage extends Model
{
    
    protected $table = 'ctg_grammages';

    use HasFactory;
    protected $fillable = [
        'name','status'
    ];
}
