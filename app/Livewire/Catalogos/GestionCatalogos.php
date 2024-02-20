<?php

namespace App\Livewire\Catalogos;

use Livewire\Component;
use App\Livewire\Forms\CatalogosForm;
use App\Models\Catalogos;

class GestionCatalogos extends Component
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
    public $ctg;
    public $imagen_existe= false;
    //recibo el tipo de catalogo...
    public function mount(Catalogos $ctg)
    {
        $this->ctg = $ctg;

    }
    public function render()
    {
        if ($this->readyToLoad) {

            $catalogos = $this->form->getAllCtg($this->sort, $this->orderBy, $this->list, $this->ctg);
        } else {
            $catalogos = [];
        }

        return view('livewire.catalogos.gestion-catalogos', ['catalogos' => $catalogos]);
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
    public function loadCatalogos()
    {
        $this->readyToLoad = true;
    }
}
