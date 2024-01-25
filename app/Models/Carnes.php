<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carnes extends Model
{
    use HasFactory;

    protected $fillable = [
       
        'gramaje_total',
        'gramaje_virtual',
        'ctg_grammage_id',
        'ctg_tipo_carnes_id',
    ];

    public function details()
    {
        return $this->hasMany(CarnesDetails::class);
    }

    public function grammage()
    {
        return $this->belongsTo(Grammage::class,'ctg_grammage_id' );
    }

    public function tipo()
    {
        return $this->belongsTo(ctg_tipo_carne::class,'ctg_tipo_carnes_id' );
    }
}
