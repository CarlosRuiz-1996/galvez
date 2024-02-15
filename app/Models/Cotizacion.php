<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;
    protected $table = 'cotizacions';

    protected $fillable = [
        'status',
        'total',
        'folio',
        'user_id',
        'updated_at'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
