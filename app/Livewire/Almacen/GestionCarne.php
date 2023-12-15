<?php

namespace App\Livewire\Almacen;

use Livewire\Component;
use App\Livewire\Forms\CarneForm;
class GestionCarne extends Component
{  public $openCarnes = TRUE;

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
    public function openModalCarnes()
    {
      
        $this->openCarnes = true;
    }
    public function closeModalCarnes()
    {

        $this->openCarnes = false;
    }

    public function render()
    {
        return view('livewire.almacen.gestion-carne');
    }
    public $cantidad = 0;
    public $checkboxes = [];

    
    public function saveE(){


        dd($this->form->tipoE,$this->form->catidadE,$this->form->grasaE,$this->form->huesoE);

        // $this->form->store();
    }

}
