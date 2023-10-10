<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'grammage_id',
        'gramaje',
        'presentation_id',
        'brand_id',
        'category_id',
        'price',
        'iva_id',
        'ieps_id',
        'total',
        'stock',
        'image_path'
        // Agrega aquí otros campos que desees que sean asignables en masa
    ];
    public function grammage()
    {
        return $this->belongsTo(Grammage::class);
    }
    public function Categories()
    {
        return $this->belongsTo(Categories::class);
    }
    public function presentation()
    {
        return $this->belongsTo(Presentation::class);
    }
    public function Brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function iva()
    {
        return $this->belongsTo(Iva::class);
    }
    public function ieps()
    {
        return $this->belongsTo(Ieps::class);
    }
}
