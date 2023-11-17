<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $primaryKey = 'idmunicipio';

    protected $table = 'cat_municipios';
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'idestado');
    }
}
