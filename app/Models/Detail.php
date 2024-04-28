<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $table = 'details';

    protected $fillable = [
        'user_id',
        'cliente_product_id',
        'order_id',
        'amount',
        'created_at',
        'updated_at',
        'status_detail'
        // otros campos permitidos en masa
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function detalles()
    {
        return $this->hasMany(Detail::class);
    }

    public function clienteProduct(){
        return $this->belongsTo(ClienteProduct::class);

    }
}
