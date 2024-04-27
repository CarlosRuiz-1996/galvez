<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprasSolicitudes extends Model
{
    use HasFactory;
    protected $table= "compras_solicitudes";
    protected $fillable = ['product_id','cantidad','urgencia','mensaje','status','user_id','cliente_product_id'];


    public function producto(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
