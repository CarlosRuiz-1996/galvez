<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'id'; // o el nombre de tu clave primaria si es diferente

    protected $fillable = [
        'name',
        'description',
        'ctg_grammage_id',
        'gramaje',
        'ctg_presentation_id',
        'ctg_brand_id',
        'ctg_category_id',
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
        return $this->belongsTo(Grammage::class,'ctg_grammage_id' );
    }
    public function Categories()
    {
        return $this->belongsTo(Categories::class, 'ctg_category_id');
    }
    public function presentation()
    {
        return $this->belongsTo(Presentation::class, 'ctg_presentation_id');
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
