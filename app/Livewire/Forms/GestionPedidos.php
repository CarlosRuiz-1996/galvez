<?php

namespace App\Livewire\Forms;

use App\Models\ClienteProduct;
use App\Models\ComprasSolicitudes;
use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class GestionPedidos extends Form
{
    //
    public $deadline;
    public $total;
    public $observations;
    public $user_id;
    public $search = "";
    public $search_prod = "";
    public $filtra_cat = 0;

    protected $rules = [
        'deadline' => 'required',
        'total' => 'required', // Ajusta según tus necesidades
        'observations' => 'required',

    ];
    //read productos categoria
    public function readOrders($sort, $orderBy, $list)
    {
        $userID = Auth::id(); // Asegúrate de tener disponible el ID del usuario logueado

        return Order::where('deadline', 'like', '%' . $this->search . '%')
            ->Where('observations', 'like', '%' . $this->search . '%')

            ->Where('total', 'like', '%' . $this->search . '%')
            ->Where('created_at', 'like', '%' . $this->search . '%')
            ->where('user_id', $userID) // Agrega esta condición


            ->orderBy($sort, $orderBy)
            ->paginate($list);
    }


    public function readOrdersAbastecimiento($sort, $orderBy, $list)
    {
        return Order::where('deadline', 'like', '%' . $this->search . '%')
            ->orWhere('observations', 'like', '%' . $this->search . '%')
            ->orWhere('total', 'like', '%' . $this->search . '%')
            ->orWhere('created_at', 'like', '%' . $this->search . '%')
            ->orWhereHas('user', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%')
                    ->orWhere('cliente', 'like', '%' . $this->search . '%');
            })
            ->orderBy($sort, $orderBy)
            ->paginate($list);
    }

    public function readPedidoProducts($order_id)
    {

        return Order::with(
            'details.clienteProduct.product.presentation',
            'details.clienteProduct.product.grammage',
            'details.clienteProduct.product.brand'
        )
            ->find($order_id)->details;
    }



    // public function readProduct($id)
    // {
    //     return ClienteProduct::join('products', 'cliente_products.product_id', '=', 'products.id')
    //         ->where('cliente_products.user_id', $id)
    //         ->where(function ($query) {
    //             $query->where('products.name', 'like', '%' . $this->search_prod . '%')
    //                 ->orWhere('cliente_products.description', 'like', '%' . $this->search_prod . '%')
    //                 ->orWhere('cliente_products.max', 'like', '%' . $this->search_prod)
    //                 ->orWhere('cliente_products.min', 'like', '%' . $this->search_prod);
    //         })
    //         ->when(!empty($this->filtra_cat), function ($query) {
    //             return $query->where('ctg_category_id', '=', $this->filtra_cat);
    //         })
    //         ->orderBy('cliente_products.id', 'desc')
    //         ->paginate(2);
    // }

    public function readProduct($id)
    {
        return ClienteProduct::join('products', 'cliente_products.product_id', '=', 'products.id')
            ->where('cliente_products.user_id', $id)
            ->where(function ($query) {
                $query->where('products.name', 'like', '%' . $this->search_prod . '%')
                    ->orWhere('cliente_products.description', 'like', '%' . $this->search_prod . '%')
                    ->orWhere('cliente_products.max', 'like', '%' . $this->search_prod)
                    ->orWhere('cliente_products.min', 'like', '%' . $this->search_prod);
            })
            ->when(!empty($this->filtra_cat), function ($query) {
                return $query->where('ctg_category_id', '=', $this->filtra_cat);
            })
            ->select(
                'cliente_products.*',  // Todos los campos de cliente_products
                'products.name as product_name',  // Alias para el campo 'name' de la tabla products
                // Agrega más alias según sea necesario para otros campos comunes
            )
            ->orderBy('cliente_products.id', 'desc')
            ->paginate(100);
    }
    public function store()
    {

        $this->validate();


        $this->user_id = auth()->user()->id;
        // die();
        $order = Order::create($this->only(['deadline', 'observations', 'total', 'user_id']));


        $orderId = $order->id;

        $productos = Session::get('productosArrayCliente', []);

        if (count($productos)) {
            foreach ($productos as $producto) {
                Detail::create([
                    'amount' => 1,
                    'order_id' => $orderId,
                    'cliente_product_id' => $producto['id'],

                ]);
            }
        }




        $this->reset();
    }

    public function getOneProduct($id)
    {

        return Product::findOrFail($id);
    }


    public function solicitudCompras($producto_id, $cantidad, $existe,$cliente_product_id)
    {

        $msg = $existe == 2 ? 'Orden surtida con el minimo' : 'No se ha podido surtir orden.';

        $solicitudes = ComprasSolicitudes::where('cliente_product_id', $cliente_product_id)->where('status', 1)->count();


        if ($solicitudes ==0) {
            ComprasSolicitudes::create([
                'product_id' => $producto_id,
                'cantidad' => $cantidad,
                'urgencia' => $existe,
                'mensaje' => $msg,
                'user_id' => auth()->user()->id,
                'cliente_product_id'=>$cliente_product_id
            ]);
        } 
    }
}
