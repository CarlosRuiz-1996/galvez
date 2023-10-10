<?php

namespace App\Livewire;

use App\Livewire\Forms\ProductForm;
use Livewire\Component;
use App\Models\Product;

class SearchProducts extends Component
{

    

    public ProductForm $form;
    public $open = false;
    public $nameProduct;
    public $detalle;
    public $imagenPath;

    public function showMore(Product $product)
    {
        // dd($product);

        $this->nameProduct= $product->name;
        $this->detalle= $product->description;
        $this->imagenPath = $product->image_path;
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
        $this->reset('nameProduct','detalle','imagenPath');
    }

    public function render()
    {
        $categories = $this->form->readCategory();
        $products = $this->form->readProduct();
        return view('livewire.search-products', ['products'=>$products, 'categories'=>$categories]);
    }
}
