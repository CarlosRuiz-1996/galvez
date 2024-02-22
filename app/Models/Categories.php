<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    
    protected $table = 'ctg_categories';
    protected $fillable = [
        'name',
        'image_path','status'
    ];
}
