<?php

namespace App\Livewire\Clientes;

use App\Models\User;
use Livewire\Component;

class GestionClientes extends Component
{
    public $readyToLoad = false;
    public $sort = "id";
    public $list = '10';

    public $orderBy = "desc";
    protected $queryString = [
        'list' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'orderBy' => ['except' => 'desc'],
        'form.search' => ['except' => ''],
    ];
    public function render()
    {
        $users = User::role('2')->paginate(5);
        return view('livewire.clientes.gestion-clientes', ['users'=>$users]);
    }
    //renderisa la tabla una ves que carga la pagina
    public function loadUsers()
    {
        $this->readyToLoad = true;
    }
}
