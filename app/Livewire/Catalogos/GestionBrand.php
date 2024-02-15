<?php

namespace App\Livewire\Catalogos;

use Livewire\Component;
use App\Livewire\Forms\CatalogosForm;

class GestionBrand extends Component
{

    public CatalogosForm $form;
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
    public function render()
    {
        if ($this->readyToLoad) {

            $brands = $this->form->getAllBrands($this->sort, $this->orderBy, $this->list);
        } else {
            $brands = [];
           
        }

        return view('livewire.catalogos.gestion-brand',['brands'=>$brands]);
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
 
     public function updatingSearch()
     {
         $this->resetPage();
     }
 
     //renderisa la tabla una ves que carga la pagina
     public function loadBrands()
     {
         $this->readyToLoad = true;
     }
}
