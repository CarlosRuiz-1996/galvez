<?php

namespace App\Livewire;

use App\Livewire\Forms\ProductForm;
use App\Models\Brand;
use App\Models\Categories;
use App\Models\Grammage;
use App\Models\Presentation;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\File;

class GestionProduct extends Component
{
    use WithFileUploads;
    use WithPagination;
    public ProductForm $form;

    public $category, $identificador, $image;
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
        $this->reset([ 'image', 'productId']);
        // 'form.name', 'form.description', 'form.gramaje', 'form.grammage_id', 
        // 'form.brand_id', 'form.presentation_id', 'form.category_id',
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


    public function mount(Categories $category)
    {
        $this->category = $category;
        //para poder setear la imagen input
        $this->identificador = rand();
    }

    #[On('show-productos')]
    public function render()
    {
        if ($this->readyToLoad) {
            $brands = Brand::all();
            $presentations = Presentation::all();
            $grammages = Grammage::all();

            $products = $this->form->readProductCategory($this->category->id, $this->sort, $this->orderBy, $this->list);
        } else {
            $brands = [];
            $presentations = [];
            $products = [];
            $grammages = [];
        }

        return view('livewire.gestion-product', [
            'products' => $products,
            'presentations' => $presentations,
            'brands' => $brands,
            'grammages' => $grammages
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

    //guardar datos nuevos

    #[On('save-productos')]
    public function save()
    {

        if($this->image){
            $this->form->image_path = $this->image->store('products'); //-la imagen se guarda con la ruta products/image.jpg
        }
        $this->form->category_id = $this->category->id;


        $this->form->store();
        $this->reset(['open', 'image']);
        $this->identificador = rand();

        $this->dispatch('show-productos');
        $this->dispatch('alert', "El producto se creo satisfactoriamente.");
        $this->closeModal();
    }


    public function edit(Product $product)
    {
        $this->form->setProduct($product);
        $this->productId = $product->id;
        $this->openModal();
    }
    #[On('update-productos')]
    public function update()
    {

        if ($this->image) {
            File::delete([$this->form->image_path]);
            $this->form->image_path = $this->image->store('products');
        }
        $this->form->update();

        $this->reset('image', 'productId');
        $this->identificador = rand();
        $this->dispatch('show-productos');
        $this->dispatch('alert', "El producto se actializo satisfactoriamente.");
        $this->closeModal();
    }

    
}
