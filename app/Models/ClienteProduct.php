<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteProduct extends Model
{
    use HasFactory;
    protected $table = 'cliente_products';

    protected $fillable = [
        'description',
        'max',
        'min',
        'user_id',
        'product_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
