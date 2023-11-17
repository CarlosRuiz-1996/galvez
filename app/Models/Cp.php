<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cp extends Model
{
    use HasFactory;
    protected $table = 'cat_cp';

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'idmunicipio');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'idestado');
    }
}
