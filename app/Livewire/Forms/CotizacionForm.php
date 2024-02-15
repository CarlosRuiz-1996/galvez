<?php

namespace App\Livewire\Forms;

use App\Models\ClienteFood;
use App\Models\ClienteProduct;
use App\Models\Cotizacion;
use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CotizacionForm extends Form
{

    public $search;


    public function readCotizaciones($sort, $orderBy, $list)
    {

        return Cotizacion::select('cotizacions.*')
        ->join('users', 'cotizacions.user_id', '=', 'users.id')
        ->where('cotizacions.status', '=', 1)
        ->when($this->search, function ($query) {
            return $query->where('cotizacions.updated_at', 'like', '%' . $this->search . '%')
                ->orWhere('users.name', 'like', '%' . $this->search . '%')
                ->orWhere('users.email', 'like', '%' . $this->search . '%')
                ->orWhere('users.cliente', 'like', '%' . $this->search . '%')
                ->orWhere('users.rfc', 'like', '%' . $this->search . '%')
                ->orWhere('users.phone', 'like', '%' . $this->search . '%');
        })
        ->orderBy($sort, $orderBy)
        ->paginate($list);
    }


    public function readCotizacionProducts($id_user)
    {


        // return ClienteProduct::with(['product', 'product.presentation', 'grammages'])
        return  ClienteProduct::with(['product', 'product.presentation', 'product.grammage'])
            ->where('user_id', '=', $id_user)
            ->where('status', '=', 2)
            ->orderBy('user_id', 'desc')
            ->paginate(5);
    }
    public function readCotizacionFoods($id_user)
    {


        // return ClienteProduct::with(['product', 'product.presentation', 'grammages'])
        return  ClienteFood::with(['food', 'food.presentation', 'food.categorie'])
            ->where('user_id', '=', $id_user)
            ->where('status', '=', 2)
            ->orderBy('user_id', 'desc')
            ->paginate(5);
    }

    public function searchCliente($cliente)
    {
        return  User::where('name', 'like', '%' . $cliente . '%')
            ->orWhere('no_contrato', 'like', '%' . $cliente . '%')
            ->orWhere('rfc', 'like', '%' . $cliente . '%')
            ->orWhere('cliente', 'like', '%' . $cliente . '%')

            ->get()->toArray();
    }
}
