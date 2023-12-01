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
    protected $table = 'orders';
    protected $fillable = [
        'deadline',
        'observations',
        'total',
        'user_id',
    ];

    public function detalles()
    {
        return $this->hasMany('App\Models\Detail');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(Detail::class);
    }
}
