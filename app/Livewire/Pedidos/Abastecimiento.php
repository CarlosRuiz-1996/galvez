<?php

namespace App\Livewire\Pedidos;

use Livewire\Component;
use App\Livewire\Forms\GestionPedidos;
use Livewire\WithPagination;

class Abastecimiento extends Component
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
    
}
