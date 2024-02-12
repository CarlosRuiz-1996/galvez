<?php

namespace App\Livewire\Forms;

use App\Models\ClienteFood;
use App\Models\ClienteProduct;
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

        return DB::table('cliente_products as c')
            ->join('users as u', 'u.id', '=', 'c.user_id')
            ->select('u.id', DB::raw('MAX(u.name) as name'), DB::raw('MAX(u.email) as email'), DB::raw('MAX(u.cliente) as cliente'), DB::raw('MAX(u.rfc) as rfc'), DB::raw('MAX(u.phone) as phone'),  DB::raw('MAX(c.created_at) as created_at'))
            ->where('c.status', 2)
            ->where(function ($query) {
                $query->where('u.name', 'like', '%' . $this->search . '%')
                    ->orWhere('u.email', 'like', '%' . $this->search . '%')
                    ->orWhere('u.cliente', 'like', '%' . $this->search . '%')
                    ->orWhere('u.rfc', 'like', '%' . $this->search . '%')
                    ->orWhere('u.phone', 'like', '%' . $this->search . '%')
                    ->orWhere('c.created_at', 'like', '%' . $this->search . '%');
            })
            ->groupBy('u.id') // Agrupar solo por el campo id de users
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


    public function searchCliente($cliente)
    {
        return  User::where('name', 'like', '%' . $cliente . '%')
            ->orWhere('no_contrato', 'like', '%' . $cliente . '%')
            ->orWhere('rfc', 'like', '%' . $cliente . '%')
            ->orWhere('cliente', 'like', '%' . $cliente . '%')

            ->get()->toArray();
    }
}
