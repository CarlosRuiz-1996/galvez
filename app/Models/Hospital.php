<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $table = 'hospitals';

    // relacion One to Many
    public function pedidos()
    {
        // llamo a otro modelo
        return $this->hasMany('App\Models\Order');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }
    
    public function user() {
        return $this->belongsToMany(User::class, 'user_hospital');
    }
}
