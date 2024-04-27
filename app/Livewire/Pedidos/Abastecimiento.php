<?php

namespace App\Livewire\Pedidos;

use Livewire\Component;
use App\Livewire\Forms\GestionPedidos;
use Livewire\WithPagination;
use App\Models\User;
use Livewire\Attributes\On;

class Abastecimiento extends Component
{

    public GestionPedidos $form;
    use WithPagination;

    public $identificador, $image;
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
    ];

    //renderisa la tabla una ves que carga la pagina
    public function loadOrders()
    {
        $this->readyToLoad = true;
    }
    public function render()
    {

        if ($this->readyToLoad) {


            $orders = $this->form->readOrdersAbastecimiento($this->sort, $this->orderBy, $this->list);
        } else {
            $orders = [];
        }

        return view('livewire.pedidos.abastecimiento', [
            'orders' => $orders,


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


    public $products;
    public $existencias = [];
    public $apartar = 1;
    public function detail($id)
    {
        $products = $this->form->readPedidoProducts($id);

        foreach ($products as $detail) {

            if ($detail->clienteProduct->product->stock >= $detail->clienteProduct->max) {
                $existe = 1;
            } elseif ($detail->clienteProduct->product->stock < $detail->clienteProduct->max && $detail->clienteProduct->product->stock > $detail->clienteProduct->min) {
                $existe = 2;
            } else {
                $existe = 0;
                $this->apartar = 0;
            }
            $this->existencias[$detail->id] = [
                'id' => $detail->id,
                'existe' => $existe
            ];
        }

        $this->products = $products->toArray();

        $this->openModal();
    }

    public $open = false;
    public function openModal()
    {
        $this->open = true;
    }
    public function closeModal()
    {
        $this->open = false;
        $this->reset('products', 'apartar');
    }

    #[On('apartar-orden')]
    public function save()
    {
        foreach ($this->products as $detail) {

            
            // $detail->clienteProduct->product->stock; //stock para descontar
            // $detail->clienteProduct->max; //monto a descontar.
            // $detail->clienteProduct->min;
            if ($detail['id'] == $this->existencias[$detail['id']]['id'] && $this->existencias[$detail['id']]['existe'] == 1) {
                dd('lleva maximo');
            } elseif ($detail['id'] == $this->existencias[$detail['id']]['id']&& $this->existencias[$detail['id']]['existe'] == 2) {
                dd('lleva minimo');
            } else {
                dd('error');
            }
        }
    }
}
