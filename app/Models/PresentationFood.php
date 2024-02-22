<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresentationFood extends Model
{
    use HasFactory;
    
    protected $table = 'ctg_presentation_food';
    protected $fillable = [
        'name','status'
    ];
}
