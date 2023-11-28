<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteFood extends Model
{
    use HasFactory;
    
    protected $table = 'cliente_foods';

    protected $fillable = [
        'description',
        'max',
        'min',
        'user_id',
        'food_id',
        'status'
    ];


    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
