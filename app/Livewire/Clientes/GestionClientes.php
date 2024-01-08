<?php

namespace App\Livewire\Clientes;

use App\Models\User;
use Livewire\Component;
use App\Livewire\Forms\ClienteForm;
use Livewire\WithPagination;

class GestionClientes extends Component
{
    public ClienteForm $form;
    use WithPagination;

    public $readyToLoad = false;
    public $sort = "id";
    public $list = '10';
    public $entrada = array('5', '10', '15', '20', '50', '100');


    public $orderBy = "desc";
    protected $queryString = [
        'list' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'orderBy' => ['except' => 'desc'],
        'form.search' => ['except' => ''],
    ];
    public function render()
    {
        // $users = User::role('2')->paginate(5);
        $users = $this->form->getAll($this->sort, $this->orderBy, $this->list);

        return view('livewire.clientes.gestion-clientes', ['users' => $users]);
    }
    //renderisa la tabla una ves que carga la pagina
    public function loadUsers()
    {
        $this->readyToLoad = true;
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

    public function redirectToRoute()
    {
        // Aquí puedes personalizar la ruta a la que deseas redirigir

        return redirect()->to('/admin/clientes/crear');
    }
    

}
