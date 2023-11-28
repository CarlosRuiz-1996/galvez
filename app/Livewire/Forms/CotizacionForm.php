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

            return  User::where('status_user','=',1)
            ->orderBy($sort, $orderBy)
            ->paginate($list);
    }

   
}
