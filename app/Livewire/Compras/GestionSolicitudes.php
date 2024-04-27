<?php

namespace App\Livewire\Compras;

use Livewire\Component;
use App\Livewire\Forms\ComprasForm;
use App\Models\Product;
use Livewire\WithPagination;
use Livewire\Attributes\On;
class GestionSolicitudes extends Component
{

    use WithPagination;
    public ComprasForm $form;
    public $readyToLoad = false;
    public $open = false;


    public $product;
    public $cantidad;
    public function openModal(Product $product, $cantidad)
    {
        $this->product = $product;
        $this->cantidad = $cantidad;
        $this->form->name = $this->product->name;
        $this->form->gramaje = $this->product->grammage->name;
        $this->form->ctg_presentation_id = $this->product->presentation->name;
        $this->form->ctg_brand_id = $this->product->Brand->name;
        $this->form->ctg_category_id = $this->product->Categories->name;
        $this->open = true;
    }
    public function closeModal()
    {
        $this->open = false;
    }

    public function render()
    {
        $solicitudes = $this->form->Solicitudes();
        return view('livewire.compras.gestion-solicitudes', compact('solicitudes'));
    }


    //renderisa la tabla una ves que carga la pagina
    public function loadSolicitudes()
    {
        $this->readyToLoad = true;
    }


    public function updating($property, $value)
    {
        if ($property === 'form.price') {
            if ($this->form->stock != 0) {
                $this->form->total = $this->form->stock * $value;
            }
        }

        if ($property === 'form.stock') {
            if ($this->form->price != 0) {
                $this->form->total = $this->form->price * $value;
            }
        }
    }


    #[On('resolver-solicitud')]
    public function resover(){
        $this->validate([
            'form.price' => 'required|numeric|gt:0',
            'form.stock' => 'required|numeric|gt:cantidad',
        ], [
            'form.price' => 'El precio es obligatorio.',
            'form.stock.required' => 'El stock es obligatorio',
            'form.stock.gt' => 'El stock debe ser mayor que la cantidad.',
        ]);

        
        $res= $this->form->ResolverSolicitud($this->product);

        if ($res == 1) {
            $this->reset(['open', 'product','cantidad']);

            $this->dispatch('alert', ["El producto se actualizo satisfactoriamente.",'success']);
        } else {
            $this->dispatch('alert', ["Ha ocurrido un error intenta más tarde.",'error']);
        }

    }
}
