<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogos extends Model
{

    //esta tabla solo se gestiona a nivel bd, no se le puede hacer crud ya que es dll
    use HasFactory;
    protected $table = 'catalogos';

}
