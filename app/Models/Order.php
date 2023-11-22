<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // public function hospital()
    // {
    //     return $this->belongsTo(Hospital::class);
    // }
    protected $table = 'order';

    
    public function detalles()
    {
        return $this->hasMany('App\Models\Detail');
    }
    public function product_cliente()
    {
        return $this->belongsTo(ClienteProduct::class);
    }
}
