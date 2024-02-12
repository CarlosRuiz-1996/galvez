<?php

namespace App\Livewire\Cotizaciones;

use Livewire\Component;
use App\Livewire\Forms\ClienteForm;
use App\Livewire\Forms\CotizacionForm;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class CrearCotizacion extends Component
{

    
    public CotizacionForm $form;
    public ClienteForm $form_cliente;
    use WithPagination;


    public function render()
    {
        return view('livewire.cotizaciones.crear-cotizacion');
    }

    //clientes
    public $openCli = false;
    public $search;
    public $clientes = [];
    public function openModalCli()
    {
        $this->openCli = true;
    }
    public function closeModalCli()
    {
        $this->openCli = false;
    }

    public function searchCliente()
    {

        if (!empty($this->search)) {
            $this->clientes =  $this->form->searchCliente($this->search);
        } else {
            $this->clientes = [];
        }
    }

    public function clienteSelect(User $user)
    {
        // dd($user->id);
        
        $this->form_cliente->cliente_existente = $user;

        $this->form_cliente->activo = true;
        $this->form_cliente->no_contrato = $user->no_contrato;
        $this->form_cliente->cliente = $user->cliente;
        $this->form_cliente->name = $user->name;
        $this->form_cliente->phone = $user->phone;
        $this->form_cliente->email = $user->email;
        $this->form_cliente->rfc = $user->rfc;
       
        $this->clientes = [];
        $this->search = '';
        $this->closeModalCli();
        

    }


    
    public function validarCp()
    {

        $this->validate([
            'form_cliente.cp' => 'required|digits_between:1,5',
        ], [
            'form_cliente.cp.digits_between' => 'El código postal solo contiene 5 digitos.',
            'form_cliente.cp.required' => 'Código postal requerido.',

        ]);

        $this->form_cliente->validarCp();
    }


    //guardar cotizacion
    #[On('save-cotizacion')]
    public function save()
    {
        $this->form_cliente->store(2);
        session()->forget('productosArray');
        session()->forget('FoodsArray');
        $this->dispatch('alert', "  Cotizacion creada con exito.");
    }
}
