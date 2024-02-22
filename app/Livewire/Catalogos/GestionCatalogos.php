<?php

namespace App\Livewire\Catalogos;

use Livewire\Component;
use App\Livewire\Forms\CatalogosForm;
use App\Models\Catalogos;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\File;

class GestionCatalogos extends Component
{
    use WithFileUploads;

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
    public $identificador, $image, $ctgId;
    public $imagen_existe= false;
    //recibo el tipo de catalogo...
    public function mount(Catalogos $ctg)
    {
        $this->form->ctg = $ctg;
        $this->identificador = rand();
    }
    public function render()
    {
        if ($this->readyToLoad) {

            $catalogos = $this->form->getAllCtg($this->sort, $this->orderBy, $this->list);
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

    // modal
    public $openC = false;

    public function openModalC()
    {
        $this->resetValidation();
        $this->openC = true;
    }
    public function closeModalC()
    {
        $this->openC = false;

      
    }


    // CREAR
    #[On('save-ctg')]
    public function save()
    {

        if($this->image){
            $this->form->image_path = $this->image->store('catalogs_image'); //-la imagen se guarda con la ruta products/image.jpg
        }

        $this->form->store($this->image);
        $this->reset(['openC', 'image','imagen_existe']);
        $this->identificador = rand();

        $this->dispatch('alert', "El registro se agrego al catalogo exitosamente.");
        $this->closeModalC();
    }


    public function edit($ctg)
    {     
        

        $this->ctgId = $ctg['id'];
        $this->form->setCatalogo($ctg);
        $this->openModalC();
    }


    #[On('update-ctg')]
    public function update()
    {

        if ($this->image) {
            File::delete([$this->form->image_path]);
            $this->form->image_path = $this->image->store('catalogs_image');
        }
        $this->form->update($this->image);

        $this->reset('image', 'ctgId','imagen_existe');
        $this->identificador = rand();
        // $this->dispatch('show-productos');
        $this->dispatch('alert', "El registro se actializo satisfactoriamente.");
        $this->closeModalC();
    }

    //eliminar
    #[On('delete-ctg')]
    public function delete($ctg)
    {
        $this->form->setCatalogo($ctg);
        $this->form->delete();
        $this->dispatch('alert', "El registro dio de baja.");

    }

    //reactivar
    #[On('reactive-ctg')]
    public function reactive($ctg)
    {
        $this->form->setCatalogo($ctg);
        $this->form->reactive();
        $this->dispatch('alert', "El registro se dio de alta nuevamente.");

    }
}
