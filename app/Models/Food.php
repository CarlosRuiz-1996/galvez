<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image_path',
        'ctg_presentation_food_id',
        'ctg_categories_food_id',
    ];

    public function presentation()
    {
        return $this->belongsTo(PresentationFood::class, 'ctg_presentation_food_id');
    }
    public function categorie()
    {
        return $this->belongsTo(CategoriesFood::class, 'ctg_categories_food_id');
    }

    public function ingredients(){
        return $this->hasMany(Ingredients::class);

    }
}
