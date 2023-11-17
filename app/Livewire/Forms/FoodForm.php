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
    public ?Food $food;
    public $seach_cat = "";
    public $seach_prod = "";
    public $search = "";
    public $filtra_cat=0;

    //filtro de categoria
    public function readCategory()
    {
        $query = CategoriesFood::query();

        if (!empty($this->seach_cat)) {
            $query->where('name', 'like', '%' . $this->seach_cat . '%');
        }
        if (!empty($this->filtra_cat)) {
            $query->where('id', '=',  $this->filtra_cat);
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

    public function setFood(Food $food)
    {
        $this->food = $food;

        $this->name = $food->name;
        $this->description = $food->description;
        $this->image_path = $food->image_path;
        $this->ctg_presentation_food_id = $food->ctg_presentation_food_id;
        $this->ctg_categories_food_id = $food->ctg_categories_food_id;
    }


    public function setFoodEmpty()
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
            // ->orWhereHas('presentation', function ($query) {
            //     $query->where('name', 'like', '%' . $this->search . '%');
            // })

            ->orderBy($sort, $orderBy)
            ->paginate($list);
    }

    //save datos nuevos
    public function store($ingredients)
    {
        $this->validate();

        // Crear el registro principal de Food                                 ctg_presentation_food_id 
        $food = Food::create($this->only(['name', 'description', 'image_path', 'ctg_presentation_food_id', 'ctg_categories_food_id']));

        // Recorrer el arreglo de ingredientes y crear registros para cada uno
        foreach ($ingredients as $ingredient) {
            $food->ingredients()->create([
                'name' => $ingredient['name'],
                'cantidad' => $ingredient['cantidad'],
                'gramaje' => $ingredient['gramaje'],
                'ctg_grammage_id' => $ingredient['ctg_grammage_id'],
            ]);
        }

        $this->reset();
    }

    //obtengo el nombre del gramage para mostrarlo en la vista del modal
    public function getOneGrammage($id)
    {

        return Grammage::findOrFail($id);
    }

    public function deleteIngredientsUp($ingredientesEliminados)
    {
    }

    public function update($ingredients, $ingredientesEliminados, $foodId)
    {
        $this->validate();
        $this->food->update($this->all());

        Ingredients::destroy($ingredientesEliminados);

        foreach ($ingredients as $ingredient) {
            // Verificar si el ingrediente ya existe en la base de datos
            $ingredientExistente = Ingredients::where('food_id', $foodId)
                ->where('name', $ingredient['name'])
                ->first();
            

            // Si no existe, entonces créalo
            if (!$ingredientExistente) {
                Ingredients::create([
                    'name' => $ingredient['name'],
                    'cantidad' => $ingredient['cantidad'],
                    'gramaje' => $ingredient['gramaje'],
                    'ctg_grammage_id' => $ingredient['ctg_grammage_id'],
                    'food_id'=>$foodId
                    // Agrega otros campos aquí
                ]);
            }
        }
        $this->reset('name', 'description', 'image_path', 'ctg_presentation_food_id', 'ctg_categories_food_id');
    }
}
