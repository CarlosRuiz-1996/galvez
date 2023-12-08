<?php

namespace App\Livewire\Clientes;

use Livewire\Component;
use App\Livewire\Forms\ClienteForm;
use App\Models\ClienteFood;
use App\Models\ClienteProduct;
use Livewire\WithPagination;
use App\Models\User;
use Livewire\Attributes\On;

class EditarCliente extends Component
{
    use WithPagination;

    public $user;
    public ClienteForm $form;
    public $readyToLoad = false;
    public $sortP = "id";
    public $listP = '1';
    public $entradaP = array('1', '5', '10', '15', '20', '50', '100');

    public $orderByP = "desc";
    protected $queryString = [
        'listP' => ['except' => '5'],
        'sortP' => ['except' => 'id'],
        'orderByP' => ['except' => 'desc'],
        'listPl' => ['except' => '5'],
        'sortPl' => ['except' => 'id'],
        'orderByPl' => ['except' => 'desc'],
    ];


    public function mount(User $user)
    {
        $this->user = $user;
    }


    #[On('show-productos-cliente')]
    public function render()
    {
        $this->form->setUser($this->user);


        return view(
            'livewire.clientes.editar-cliente',
            [
                'products' => $this->form->getAllProducts($this->user, $this->sortP, $this->orderByP, $this->listP),
                'foods' => $this->form->getAllFood($this->user, $this->sortPl, $this->orderByPl, $this->listPl)
            ]
        );
    }

    #[On('update-cliente')]
    public function save()
    {

        $this->form->updateCliente();
        $this->mount($this->form->user);
        $this->dispatch('alert', "Datos actualizados correctamente.");
    }

    //PRODUCTOS...

    //ordenar los filtros de las columnas
    public function orderP($sort)
    {

        if ($this->sortP == $sort) {
            if ($this->orderByP == 'desc') {
                $this->orderByP = 'asc';
            } else {
                $this->orderByP = 'desc';
            }
        } else {
            $this->sortP = $sort;
            $this->orderByP = 'desc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }


    //productos
    public $openP = false;

    public function openModalP(ClienteProduct $product)
    {
        // dd();
        $this->form->setProduct($product);
        $this->resetValidation();
        $this->openP = true;
    }
    public function closeModalP()
    {
        $this->openP = false;
    }


    #[On('update-clienteProd')]
    public function updateProd()
    {

        $this->form->updateClienteProd();
        $this->dispatch('show-productos-cliente');
        $this->dispatch('alert', "Datos del producto actualizados correctamente.");
        $this->closeModalP();
    }


    //platillos
    public $sortPl = "id";
    public $listPl = '1';
    public $entradaPl = array('1', '5', '10', '15', '20', '50', '100');

    public $orderByPl = "desc";

    public $openPl = false;

    public function openModalPl(ClienteFood $food)
    {
        // dd();
        $this->form->setFood($food);
        $this->resetValidation();
        $this->openPl = true;
    }
    public function closeModalPl()
    {
        $this->openPl = false;
    }



    #[On('update-clienteFood')]
    public function updateFood()
    {

        $this->form->updateClienteFood();
        $this->dispatch('show-productos-cliente');
        $this->dispatch('alert', "Datos del platillo actualizados correctamente.");
        $this->closeModalPl();
    }

    //paginacion de los platillos:

}
