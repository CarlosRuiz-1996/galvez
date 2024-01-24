<?php

namespace App\Models;

use Database\Seeders\CtgCarne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarnesDetails extends Model
{
    use HasFactory;

    protected $fillable = [
       
        'gramaje_total',
        'gramaje_virtual',
        'carnes_id',
        'ctg_carnes_id',
        'ctg_grammage_id'
    ];

    public function grammage()
    {
        return $this->belongsTo(Grammage::class,'ctg_grammage_id' );
    }

    public function tipo()
    {
        return $this->belongsTo(ctg_carne::class,'ctg_carnes_id' );
    }

}
