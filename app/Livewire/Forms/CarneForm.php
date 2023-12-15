<?php

namespace App\Livewire\Forms;

use App\Models\Carnes;
use Livewire\Attributes\Rule;
use Livewire\Form;

class CarneForm extends Form
{

    
    public $grasaE;
    public $huesoE;
    public $bisteckE;
    public $tipoE;

    public $grasaP;
    public $huesoP;
    public $bisteckP;
    public $tipoP;

    public $catidadE;
    public $catidadP;

    public function storeE(){
        Carnes::create($this->only(['tipo','catidad','grasa','hueso','bisteck']));

    }
}
