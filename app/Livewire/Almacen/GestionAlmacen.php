<?php

namespace App\Livewire\Almacen;

use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Forms\AlmacenForm;
use App\Models\Product;
use Livewire\Attributes\On;

class GestionAlmacen extends Component
{

    use WithPagination;
    public AlmacenForm $form;

    public $entrada = array('5', '10', '15', '20', '50', '100');
    public $list = '10';
    public $readyToLoad = false;
    public $sort = "id";
    public $orderBy = "desc";
    public $open = false;
    public $productId;
  
    public function openModal(Product $product)
    {
        $this->form->product = $product;
        $this->form->stock = $product->stock;
        $this->form->name = $product->name;
        $this->form->stock_min = $product->stock_min;

        $this->productId= $product->id;
        $this->open = true;
    }
    public function closeModal()
    {
        $this->reset('productId');

        $this->open = false;
    }
    protected $queryString = [
        'list' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'orderBy' => ['except' => 'desc'],
        'form.search' => ['except' => ''],
    ];

    //renderisa la tabla una ves que carga la pagina
    public function loadProducts()
    {
        $this->readyToLoad = true;
    }

    #[On('show-productosStock')]
    public function render()
    {
        
        if ($this->readyToLoad) {


            $products = $this->form->readProducts($this->sort, $this->orderBy, $this->list);
        } else {
            $products = [];
        }

        return view('livewire.almacen.gestion-almacen',['products'=>$products]);
    }


    
    //ordenar los filtros de las columnas
    public function order($sort)
    {

        if ($this->sort == $sort) {
            if ($this->orderBy == 'desc') {
                $this->orderBy = 'asc';
            } else {
                $this->orderBy = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->orderBy = 'desc';
        }
    }


    #[On('update-productosStock')]
    public function save(){
        $this->form->update();

        $this->dispatch('show-productosStock');
        $this->dispatch('alert', "El producto se actializo satisfactoriamente.");
        $this->closeModal();
    }
}
