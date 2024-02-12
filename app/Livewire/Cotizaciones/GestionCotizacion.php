<?php

namespace App\Livewire\Cotizaciones;

use Livewire\Component;
use App\Livewire\Forms\CotizacionForm;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class GestionCotizacion extends Component
{


    public CotizacionForm $form;
    use WithPagination;

    public $entrada = array('5', '10', '15', '20', '50', '100');
    public $list = '10';
    public $readyToLoad = false;
    public $sort = "c.created_at";
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

        session()->forget('productosArray');
        session()->forget('FoodsArray');
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
    public $openD = false;
    public $openCli = false;


    public $productosArray = [];







    //modal detalle:
    public $products;
    public function openModalD($id)
    {

        $this->resetValidation();
        $products = $this->form->readCotizacionProducts($id);
        // dd($this->products);
        $this->products = $products->toArray();

        $this->openD = true;
    }
    public function closeModalD()
    {
        $this->openD = false;
    }



    public function redirectToRoute()
    {
        // Aquí puedes personalizar la ruta a la que deseas redirigir

        return redirect()->to('/admin/cotizacion/crear');
    }
  
}
