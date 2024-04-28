<?php

namespace App\Livewire\Pedidos;

use Livewire\Component;
use App\Livewire\Forms\GestionPedidos;
use App\Models\Order;
use Livewire\WithPagination;
use App\Models\User;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Abastecimiento extends Component
{

    public GestionPedidos $form;
    use WithPagination;

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
    public $order_detail;
    public function detail($id)
    {
        $this->order_detail= Order::find($id);

        
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

            if ($existe != 1) {
                $this->form->solicitudCompras($detail->clienteProduct->product->id, $detail->clienteProduct->max, $existe, $detail->clienteProduct->id);
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
    

    public function clean(){
        $this->reset('products','order_detail','apartar','existencias','open');
        $this->apartar=1;
    }
    #[On('apartar-orden')]
    public function save()
    {

        
        try {
            DB::beginTransaction();
            foreach ($this->products as $detail) {

                $descontar = 0;
                //reviso si se manda el mini o maximo 
                if ($detail['id'] == $this->existencias[$detail['id']]['id'] && $this->existencias[$detail['id']]['existe'] == 1) {
                    $descontar = $detail['cliente_product']['max'];
                } elseif ($detail['id'] == $this->existencias[$detail['id']]['id'] && $this->existencias[$detail['id']]['existe'] == 2) {
                    $descontar = $detail['cliente_product']['min'];
                    $this->form->updateDetail($detail['id']);
                }

                //descuento del stock del producto
                $this->form->descontarStock($detail['cliente_product']['product_id'], $descontar);
            }

            //actualizo la orden de compra
            $this->form->updateOrder($this->order_detail,2);

            DB::commit();

            //limpio los campos
            $this->clean();
            $this->dispatch('alert', ["Los productos estan listos para la entrega.",'success']);

        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ["Ha ocurrido un error intenta más tarde.",'error']);

        }
    }

    
}
