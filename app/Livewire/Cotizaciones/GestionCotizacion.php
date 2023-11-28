<?php

namespace App\Livewire\Cotizaciones;

use App\Livewire\Forms\ClienteForm;
use Livewire\Component;
use App\Livewire\Forms\CotizacionForm;
use Livewire\WithPagination;

class GestionCotizacion extends Component
{

    
    public CotizacionForm $form;
    public ClienteForm $form_cliente;
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


            $orders = $this->form->readCotizaciones($this->sort, $this->orderBy, $this->list);
        } else {
            $orders = [];
        }

        // dd($orders);
        return view('livewire.cotizaciones.gestion-cotizacion', [
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


    public $open = false;
    public $productosArray = [];

    public function openModal()
    {
        $this->resetValidation();
        $this->open = true;
    }
    public function closeModal()
    {
        $this->open = false;
        session()->forget('productosArray');
        session()->forget('FoodsArray');

        //evento para el modal del cliente
        $this->dispatch('list-products');
    }

    public function validarCp()
    {

        $this->validate([
            'form_cliente.cp' => 'required|digits_between:1,5',
        ], [
            'form_cliente.cp.digits_between' => 'El código postal solo contiene 5 digitos.',
            'form_cliente.cp.required' => 'Código postal requerido.',

        ]);

        $this->form_cliente->validarCp();
    }


    public function save()
    {
        $this->form_cliente->store(2);
        session()->forget('productosArray');
        session()->forget('FoodsArray');

        //evento para el modal del cliente
        $this->dispatch('list-products');

        $this->dispatch('alert', "  Cotizacion creada con exito.");
        $this->closeModal();
    }

    
}
