<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarnesDetails extends Model
{
    use HasFactory;

    protected $fillable = [
       
        ' gramaje_total',
        'gramaje_virtual',
        'ctg_grammage_id',
        'ctg_tipo_carnes_id',
    ];


    
}
