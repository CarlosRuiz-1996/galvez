<?php

namespace App\Livewire\Pedidos;

use Livewire\Component;
use App\Livewire\Forms\GestionPedidos;
use App\Models\Categories;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;

class GestionarPedidos extends Component
{
    public GestionPedidos $form;
    use WithPagination;

    public  $identificador, $image;
    public $entrada = array('5', '10', '15', '20', '50', '100');
    public $list = '10';
    public $readyToLoad = false;
    public $sort = "id";
    public $orderBy = "desc";

    protected $queryString = [
        'list' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'orderBy' => ['except' => 'desc'],
        'form.search' => ['except' => ''],
        'form.search_prod' => ['except' => ''],

    ];
    public $open = false;
    public $openP = false;
    public $productosArray;

    public function openModal()
    {
        $this->resetValidation();
        $this->open = true;
    }
    public function closeModal()
    {
        $this->open = false;
    }

    public function openModalP()
    {
        $this->resetValidation();
        $this->openP = true;
    }
    public function closeModalP()
    {
        $this->openP = false;
    }


    //renderisa la tabla una ves que carga la pagina
    public function loadOrders()
    {
        $this->readyToLoad = true;
    }

    // public function loadProducts()
    // {
    //     $this->readyToLoad = true;
    // }


    #[On('list-products-cliente')]
    public function mount()
    {
        $this->productosArray = Session::get('productosArray', []);
        // $this->FoodsArray = Session::get('FoodsArray', []);
    }

    public function render()
    {

        if ($this->readyToLoad) {

            $userId = auth()->user()->id;

            $products = $this->form->readProduct($userId);
            $categories = Categories::all();

            $orders = $this->form->readOrders($this->sort, $this->orderBy, $this->list);
        } else {
            $orders = [];
            $products = [];
            $categories = [];
        }

        return view('livewire.pedidos.gestionar-pedidos', [
            'orders' => $orders,
            'products' => $products,
            'categories' => $categories

        ]);
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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public $selectedProductIds = [];
   
   


    public function agregarProductos()
    {

       
        foreach ($this->selectedProductIds as $x => $isSelected) {

            if ($isSelected) {
             
                $product = $this->form->getOneProduct($isSelected);

                Session::push('productosArray', [
                    'name' => $product->name,
                    'description' => $product->description,
                    'presentation' => $product->presentation->name,
                    'gramagge' => $product->grammage->name,
                    'gramaje' => $product->gramaje,
                    'image_path' => $product->image_path,
                    'id' => $isSelected

                ]);
            }
        }

        $this->dispatch('list-products-cliente');

        $this->closeModalP();

    }
}
