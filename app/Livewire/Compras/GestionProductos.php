<?php

namespace App\Livewire\Compras;

use Livewire\Component;
use App\Livewire\Forms\ProductForm;
use App\Livewire\Forms\ComprasForm;
use App\Models\Brand;
use App\Models\Categories;
use App\Models\Grammage;
use App\Models\Presentation;
use App\Models\Product;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\File;

class GestionProductos extends Component
{



    use WithFileUploads;
    use WithPagination;
    public ComprasForm $form;

    public $identificador, $image;
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
    public $open = false;
    public $productId; //VARIABLE PARA CUANDO EDITE
    //GESTION MODAL
    public function create()
    {
        $this->reset(['image', 'productId']);

        $this->form->setProductEmpty();
        $this->openModal();
    }

    public function openModal()
    {
        $this->resetValidation();
        $this->open = true;
    }
    public function closeModal()
    {
        $this->open = false;
    }


    public function mount()
    {
        //para poder setear la imagen input
        $this->identificador = rand();
    }

    #[On('show-productos')]
    public function render()
    {
        // 
        if ($this->readyToLoad) {
            $brands = Brand::all();
            $presentations = Presentation::all();
            $grammages = Grammage::all();
            $categories = Categories::all();
            $products = $this->form->readProduct($this->sort, $this->orderBy, $this->list);
        } else {
            $brands = [];
            $presentations = [];
            $products = [];
            $grammages = [];
            $categories = [];
        }

        return view('livewire.compras.gestion-productos', [
            'products' => $products,
            'presentations' => $presentations,
            'brands' => $brands,
            'grammages' => $grammages,
            'categories' => $categories
        ]);
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
    public function loadProducts()
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


    //guardar datos nuevos

    #[On('save-productos-compras')]
    public function save()
    {
        if ($this->image) {
            $this->form->image_path = $this->image->store('products'); //-la imagen se guarda con la ruta products/image.jpg
        }

        $res = $this->form->store();

        if ($res == 1) {
            $this->reset(['open', 'image']);
            $this->identificador = rand();

            $this->dispatch('show-productos');
            $this->dispatch('alert', ["El producto se creo satisfactoriamente.",'success']);
            $this->closeModal();
        } else {
            $this->dispatch('alert', ["Ha ocurrido un error intenta más tarde.",'error']);
        }
    }


    // public function edit(Product $product)
    // {
    //     $this->form->setProduct($product);
    //     $this->productId = $product->id;
    //     $this->openModal();
    // }
    // #[On('update-productos-compras')]
    // public function update()
    // {

    //     if ($this->image) {
    //         File::delete([$this->form->image_path]);
    //         $this->form->image_path = $this->image->store('products');
    //     }
    //     $this->form->update();

    //     $this->reset('image', 'productId');
    //     $this->identificador = rand();
    //     $this->dispatch('show-productos');
    //     $this->dispatch('alert', "El producto se actializo satisfactoriamente.");
    //     $this->closeModal();
    // }
}