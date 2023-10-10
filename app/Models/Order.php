<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    
    public function detalles()
    {
        return $this->hasMany('App\Models\Detail');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
