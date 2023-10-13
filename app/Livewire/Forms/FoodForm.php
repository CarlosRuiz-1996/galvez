<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;
use App\Models\CategoriesFood;
use App\Models\Food;
use App\Models\Grammage;
use App\Models\Ingredients;

class FoodForm extends Form
{

    public $name;
    public $description;
    public $image_path;

    public $ctg_presentation_food_id;
    public $ctg_categories_food_id;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'image_path' => 'required',
        'ctg_presentation_food_id' => 'required',
        'ctg_categories_food_id' => 'required'
    ];
    public ?Food $product;
    public $seach_cat = "";
    public $seach_prod = "";
    public $search = "";

    //filtro de categoria
    public function readCategory()
    {
        $query = CategoriesFood::query();

        if (!empty($this->seach_cat)) {
            $query->where('name', 'like', '%' . $this->seach_cat . '%');
        }

        return $query->get();
    }
    //filtro de productos
    public function readProduct()
    {

        if (!empty($this->seach_prod)) {
            return  Food::where('name', 'like', '%' . $this->seach_prod . '%')->orderBy('id', 'desc')->get();
        }
    }


    public function setProductEmpty()
    {
        $this->name = "";
        $this->description = "";
        $this->image_path = "";
        $this->ctg_presentation_food_id = "";
        $this->ctg_categories_food_id = "";
    }

    //read productos categoria
    public function readProductCategory($id, $sort, $orderBy, $list)
    {
        return Food::where('ctg_categories_food_id', '=', $id)
            ->Where('name', 'like', '%' . $this->search . '%')

            ->Where('description', 'like', '%' . $this->search . '%')
            ->WhereHas('presentation', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })

            ->orderBy($sort, $orderBy)
            ->paginate($list);
    }

    //save datos nuevos
    public function store($ingredients)
{
    $this->validate();

    // Crear el registro principal de Food                                 ctg_presentation_food_id 
    $food = Food::create($this->only(['name', 'description','image_path', 'ctg_presentation_food_id', 'ctg_categories_food_id' ]));

    // Recorrer el arreglo de ingredientes y crear registros para cada uno
    foreach ($ingredients as $ingredient) {
        $food->ingredients()->create([
            'name' => $ingredient['name'],
            'cantidad' => $ingredient['quantity'],
            'gramaje' => $ingredient['grammage'],
            'ctg_grammage_id' => $ingredient['id_selectedGrammage'],
        ]);
    }

    $this->reset();
}

    public function getOneGrammage($id)
    {

        return Grammage::findOrFail($id);
    }
}
