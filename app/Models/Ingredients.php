<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cantidad',
        'gramaje',
        'ctg_grammage_id',
        'food_id',
    ];

    public function grammage()
    {
        return $this->belongsTo(Grammage::class,'ctg_grammage_id' );
    }

    public function food()
    {
        return $this->belongsTo(Food::class,'food_id' );
    }

}
