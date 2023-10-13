<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Forms\FoodForm;
use App\Models\Food;

class SearchFood extends Component
{


    public FoodForm $form;
    public $open = false;
    public $nameProduct;
    public $detalle;
    public $imagenPath;
    public $ingredients;

    public function showMore(Food $product)
    {
        $this->nameProduct= $product->name;
        $this->detalle= $product->description;
        $this->imagenPath = $product->image_path;
        $this->ingredients= $product->ingredients;
        $this->openModal();
    }
    public function openModal()
    {
        $this->resetValidation();

        $this->open = true;
    }
    public function closeModal()
    {
        $this->open = false;
        $this->reset('nameProduct', 'detalle', 'imagenPath');
    }
    public function render()
    {
        $categories = $this->form->readCategory();
        $products = $this->form->readProduct();
        return view('livewire.search-food', ['products' => $products, 'categories' => $categories]);
    }
}
