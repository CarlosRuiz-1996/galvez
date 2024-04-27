<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprasProductos extends Model
{
    use HasFactory;
    protected $table= "compras_productos";
    protected $fillable = ['product_id','cantidad','precio','total','status','user_id'];


    public function producto(){
        return $this->belongsTo(Product::class);
    }
}
