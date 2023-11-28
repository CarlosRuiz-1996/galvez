<?php

namespace App\Livewire\Clientes;

use Livewire\Component;
use App\Livewire\Forms\ClienteForm;

class CreateCliente extends Component
{
    public ClienteForm $form;

    public $open = false;
    public $productosArray = [];

    public function openModal()
    {
        $this->resetValidation();
        $this->open = true;
    }
    public function closeModal()
    {
        $this->open = false;
        session()->forget('productosArray');
        session()->forget('FoodsArray');

        //evento para el modal del cliente
        $this->dispatch('list-products');
    }

    public function validarCp()
    {

        $this->validate([
            'form.cp' => 'required|digits_between:1,5',
        ], [
            'form.cp.digits_between' => 'El código postal solo contiene 5 digitos.',
            'form.cp.required' => 'Código postal requerido.',

        ]);

        $this->form->validarCp();
    }


    public function render()
    {

        return view('livewire.clientes.create-cliente');
    }

    public function save()
    {
        $this->form->store(1);
        session()->forget('productosArray');
        session()->forget('FoodsArray');

        //evento para el modal del cliente
        $this->dispatch('list-products');

        $this->dispatch('alert', "El cliente se creo satisfactoriamente.");
        $this->closeModal();
    }
}
