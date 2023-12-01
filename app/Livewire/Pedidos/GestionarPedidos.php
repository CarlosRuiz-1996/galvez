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
    public $openPL = false;


    public $productosArrayCliente;

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

    public function openModalPL()
    {
        $this->resetValidation();
        $this->openPL = true;
    }
    public function closeModalPL()
    {
        $this->openPL = false;
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
        $this->productosArrayCliente = Session::get('productosArrayCliente', []);
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

                Session::push('productosArrayCliente', [
                    'name' => $product->name,
                    'descripcion' => $product->description,
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



     //borrar elementos de productos
     public function deleteIntemProd($index)
     {
         $products = Session::get('productosArrayCliente', []);
         if (count($products)) {
 
             foreach ($products as $key => $producto) {
                 if ($producto['id'] == $index) {
 
                     unset($products[$key]);
                     break;
                 }
             }
         }
 
         Session::put('productosArrayCliente', $products);
 
         $this->dispatch('list-products-cliente');
         $this->closeModalPL();
     }


     public function save()
    {
        $this->form->store();
        session()->forget('productosArrayCliente');
        // session()->forget('FoodsArray');

        //evento para el modal del cliente
        $this->dispatch('list-products-cliente');

        $this->dispatch('alert', "El pedido se realizo con exito!.");

        $this->closeModal();
    }



    public $productsDetail;
    public function detail($id){
        $products = $this->form->readPedidoProducts($id);
        $this->productsDetail = $products->toArray();
        $this->openModalD();
    }

    public $openD = false;
    public function openModalD(){
        $this->openD = true;
    }
    public function closeModalD(){
        $this->openD = false;
    }
}
