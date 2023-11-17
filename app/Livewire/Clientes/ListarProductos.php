<?php

namespace App\Livewire\Clientes;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;

class ListarProductos extends Component
{

    public $openP = false;
    public $openF = false;
    public $productosArray = [];
    public $FoodsArray = [];


    public function openModalP()
    {
        $this->resetValidation();
        $this->openP = true;
    }
    public function closeModalP()
    {
        $this->openP = false;
    }

    public function openModalF()
    {
        $this->resetValidation();
        $this->openF = true;
    }
    public function closeModalF()
    {
        $this->openF = false;
    }


    #[On('list-products')]
    public function mount()
    {
        $this->productosArray = Session::get('productosArray', []);
        $this->FoodsArray = Session::get('FoodsArray', []);
    }
    public function render()
    {
        // $this->productosArray = Session::get('productosArray', []);
        return view('livewire.clientes.listar-productos');
    }



    //borrar elementos de productos
    public function deleteIntemProd($index)
    {
        $products = Session::get('productosArray', []);
        if (count($products)) {

            foreach ($products as $key => $producto) {
                if ($producto['id'] == $index) {

                    unset($products[$key]);
                    break;
                }
            }
        }

        Session::put('productosArray', $products);

        $this->dispatch('list-products');
        $this->closeModalP();
    }
    
    //borrar elementos de platillos
    public function deleteIntemFood($index)
    {
        $foods = Session::get('FoodsArray', []);
        if (count($foods)) {

            foreach ($foods as $key => $food) {
                if ($food['id'] == $index) {

                    unset($foods[$key]);
                    break;
                }
            }
        }

        Session::put('FoodsArray', $foods);

        $this->dispatch('list-products');
        $this->closeModalF();
    }
}
