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
 
    public $seach;

  
    public function readCotizaciones($sort, $orderBy, $list)
    {

            return  User::where('status_user','=',2)
            ->orderBy($sort, $orderBy)
            ->paginate($list);
    }


    public function readCotizacionProducts($id_user){


        // return ClienteProduct::with(['product', 'product.presentation', 'grammages'])
        return  ClienteProduct::with(['product', 'product.presentation', 'product.grammage'])
            ->where('user_id','=',$id_user)
            ->where('status','=',2)
            ->orderBy('user_id', 'desc')
            ->paginate(5);


    }


   
}
