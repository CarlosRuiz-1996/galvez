<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;
use App\Models\Food;
use App\Models\Categories;

class ModalFoodForm extends Form

{
    public $image_path;
    public $name;
    public $description;
    public $gramaje;
    public $ctg_grammage_id;
    public $ctg_brand_id;
    public $ctg_presentation_id;
    public $ctg_category_id;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'gramaje' => 'required',
        'ctg_grammage_id' => 'required',
        'ctg_brand_id' => 'required',
        'ctg_presentation_id' => 'required',
        'ctg_category_id' => 'required',
        'image_path' => 'required'
    ];
    public ?Food $product;
    public $seach_cat = "";
    public $seach_food = "";
    public $search = "";
    public $filtra_cat = 0;

   

    //filtro de productos
    public function readFood()
    {
        return Food::when(!empty($this->seach_food), function ($query) {
            return $query->where('name', 'like', '%' . $this->seach_food . '%');
        })
            ->when(!empty($this->filtra_cat), function ($query) {
                return $query->where('ctg_categories_food_id', '=', $this->filtra_cat);
            })
            ->orderBy('id', 'desc')
            ->paginate(2);
    }

    //obtengo el nombre del gramage para mostrarlo en la vista del modal
    public function getOneProduct($id)
    {

        return Food::findOrFail($id);
    }
    public function setProduct(Food $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->gramaje = $product->gramaje;
        $this->ctg_grammage_id = $product->ctg_grammage_id;
        $this->image_path = $product->image_path;
        $this->ctg_brand_id = $product->ctg_brand_id;
        $this->ctg_presentation_id = $product->ctg_presentation_id;
        $this->ctg_category_id = $product->ctg_category_id;
    }
    public function setProductEmpty()
    {
        $this->name = "";
        $this->description = "";
        $this->gramaje = "";
        $this->ctg_grammage_id = "";
        $this->image_path = "";
        $this->ctg_brand_id = "";
        $this->ctg_presentation_id = "";
        $this->ctg_category_id = "";
    }
   

    //save datos nuevos
    public function store()
    {
        $this->validate();

        Food::create($this->only(['name', 'description', 'gramaje', 'ctg_grammage_id', 'ctg_brand_id', 'ctg_presentation_id', 'ctg_category_id', 'image_path']));
        $this->reset();
    }


    public function update()
    {
        $this->validate();
        $this->product->update($this->all());
        $this->reset('name', 'description', 'gramaje', 'ctg_grammage_id', 'ctg_brand_id', 'ctg_presentation_id', 'ctg_category_id', 'image_path');
    }


    public function delete()
    {
        $this->product->delete();
        $this->reset();
    }
}
