<?php

namespace App\Livewire\Forms;

use App\Models\ClienteProduct;
use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\Rule;
use Livewire\Form;

class GestionPedidos extends Form
{
    //

    public $search = "";
    public $search_prod = "";
    public $filtra_cat = 0;


    //read productos categoria
    public function readOrders($sort, $orderBy, $list)
    {
        return Order::where('deadline', 'like', '%' . $this->search . '%')
            ->Where('observations', 'like', '%' . $this->search . '%')

            ->Where('total', 'like', '%' . $this->search . '%')
            ->Where('created_at', 'like', '%' . $this->search . '%')


            ->orderBy($sort, $orderBy)
            ->paginate($list);
    }


    public function readOrdersAbastecimiento($sort, $orderBy, $list)
    {
        return Order::where('deadline', 'like', '%' . $this->search . '%')
            ->Where('observations', 'like', '%' . $this->search . '%')

            ->Where('total', 'like', '%' . $this->search . '%')
            ->Where('created_at', 'like', '%' . $this->search . '%')


            ->orderBy($sort, $orderBy)
            ->paginate($list);
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


    public function getOneProduct($id)
    {

        return Product::findOrFail($id);
    }
}
