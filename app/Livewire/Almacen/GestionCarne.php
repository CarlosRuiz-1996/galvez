<?php

namespace App\Livewire\Almacen;

use Livewire\Component;
use App\Livewire\Forms\CarneForm;
use App\Models\ctg_tipo_carne;
use Livewire\Attributes\On;

class GestionCarne extends Component
{
    public $open= false;
    
    public $ctg_carne = [];
    public $carne_tipo = [];
    public $grammages = [];

    public $selectedItems = [];
    public $GramageItems = [];

    public CarneForm $form;

    public $entrada = array('5', '10', '15', '20', '50', '100');
    public $list = '10';
    public $readyToLoad = false;
    public $sort = "id";
    public $orderBy = "desc";
    protected $queryString = [
        'list' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'orderBy' => ['except' => 'desc'],
        'form.search' => ['except' => ''],
    ];

    #[On('save-carnes')]
    public function save()
    {
        // $this->validate();

        $this->form->store($this->tipo_modal);

        // dd($this->selectedItems.'-'.$this->GramageItems);
        // dd($this->GramageItems);
        $this->dispatch('list-carnes');

        $this->dispatch('alert', "Los datos se registraron con exito.");
        $this->closeModal();
    }

    #[On('list-carnes')]
    public function render()
    {
        $this->ctg_carne  = $this->form->getAllCtgCarnes();
        $this->carne_tipo  = $this->form->getAllTypeCarnes();
        $this->grammages  = $this->form->getAllGrammage();
        $carnes  = $this->form->getAllCarne();

        return view('livewire.almacen.gestion-carne',['carnes'=>$carnes]);
    }

    public $nombre_modal="";
    public $tipo_modal="";
    public function openModal(ctg_tipo_carne $tipo)
    {
        $this->selectedItems = [];
        $this->nombre_modal=$tipo->name;
        $this->tipo_modal=$tipo->id;

        $this->open= true;
       

    }
    public function closeModal()
    {
        $this->selectedItems = [];

        $this->open= false;
      
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
}
