<?php

namespace App\Livewire\Almacen;

use Livewire\Component;
use App\Livewire\Forms\CarneForm;
use App\Models\Carnes;
use App\Models\CarnesDetails;
use App\Models\ctg_tipo_carne;
use Livewire\Attributes\On;

class GestionCarne extends Component
{
    public $open = false;

    public $ctg_carne = [];
    public $carne_tipo = [];
    public $grammages = [];

    public $selectedItems = []; //guarda el check seleccionado
    public $GramageItems = []; //guarda el valor del input del checkbox
    public $GramageItemsCtg = []; //guarda el valor del select del checkbox

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


    //reglas de validacion para los derivados de carnes
    public function rules()
    {
        $rules = [];

        foreach ($this->selectedItems as $carId => $selected) {
            if (!empty($this->GramageItems) || !empty($this->GramageItemsCtg)) {
                if ($selected) {
                    $rules["GramageItems.{$carId}"] = 'required|numeric';
                    $rules["GramageItemsCtg.{$carId}"] = 'required';
                }
            }else{
                if ($selected) {
                    $rules["selectedItems.{$carId}"] = 'required';
                    // $rules["GramageItemsCtg.{$carId}"] = 'required';
                }
            }
        }

        return $rules;
    }




    #[On('save-carnes')]
    public function save()
    {


        $this->validate();


        $kilos = 0;
        $gramos = 0;
        $darivados = [];
        $bandera = 0;
        $total = 0;
        foreach ($this->selectedItems as $item => $i) {
            // inicializo mi arreglo con los id de mi ctg de tipo de carne;
            $darivados[$bandera] = [
                'tipo_carne' => $item,
                'gramaje' => 0,
                'ctg' => 4,

            ];
            //obtengo valores de mi gramage para el tipo de carne
            foreach ($this->GramageItems as $gramma => $g) {
                if ($item == $gramma) {
                    $darivados[$bandera]['gramaje'] = $g;
                }
            }



            foreach ($this->GramageItemsCtg as $ctg => $c) {
                if ($item == $ctg) {
                    $darivados[$bandera]['ctg'] = $c;
                    //voy acumolando los kilos y gramajes para compararlos con la entrada total
                    if ($c == 1) {
                        $kilos += $darivados[$bandera]['gramaje'];
                    } else {
                        $gramos += $darivados[$bandera]['gramaje'];
                    }
                }
            }
            $bandera++;
        }

        $total += $kilos + ($gramos / 1000);

        if ($total < 1) {
            //si es mayor a 1 es un kilo
            $this->form->gramaje_total = 4;
        } else {
            //si es menor a 1 son gramos
            $this->form->gramaje_total = 1;
        }
        //reviso que los kilos de los derivados de pollo no supere la entrada general
        if ($total > $this->form->total) {
            //reasigna el valor de kilogramos
            $this->form->total = $total;
        }

        //reviso si el gramagge existe, si no lo mando en 0 a la base para que no sea null
        if($this->form->total==null){
            $this->form->total=0;
        }

        $this->form->store($this->tipo_modal, $darivados);

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
        $carnes  = $this->form->getAllCarne($this->sort, $this->orderBy, $this->list);

        return view('livewire.almacen.gestion-carne', ['carnes' => $carnes]);
    }

    public $nombre_modal = "";
    public $tipo_modal = "";
    public function openModal(ctg_tipo_carne $tipo)
    {
        $this->reset('nombre_modal', 'form.gramaje_total','form.total');

        $this->selectedItems = [];
        $this->nombre_modal = $tipo->name;
        $this->tipo_modal = $tipo->id;

        $this->open = true;
    }
    public function closeModal()
    {
        $this->selectedItems = [];
        $this->GramageItems = [];
        $this->GramageItemsCtg = [];
        $this->open = false;
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

    // editar 

    public $openEdit = false;
    public $carne;
    public function edit(CarnesDetails $carne)
    {
        $this->reset('nombre_modal', 'form.gramaje_total','form.total');

        $this->carne = $carne;
        $this->nombre_modal = $carne->tipo->name;
        $this->form->gramaje_total = $carne->ctg_grammage_id;

        $this->form->total = $carne->gramaje_total;
        $this->openEdit = true;
    }

    #[On('update-carnes')]
    public function update()
    {

        $this->form->update($this->carne);
        $this->dispatch('list-carnes');

        $this->dispatch('alert', "Los datos se actualizarón con exito.");
        $this->closeModalEdit();
    }



    public function closeModalEdit()
    {
        $this->reset('nombre_modal');

        $this->openEdit = false;
    }
}
