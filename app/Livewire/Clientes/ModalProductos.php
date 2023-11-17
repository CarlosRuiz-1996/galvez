<?php

namespace App\Livewire\Clientes;

use App\Livewire\Forms\ModalProductForm;
use Livewire\Component;
use App\Models\Product;
use App\Models\Categories;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
class ModalProductos extends Component
{
    use WithPagination;

    public $openP = false;
    public ModalProductForm $form;
    public $nameProduct;
    public $detalle;
    public $imagenPath;

    public $productosSeleccionados = [];
    public $description = [];
    public $max = [];
    public $min = [];

    //para cargar la pagina hasta que carguen los productos
    public $readyToLoad = false;
    protected $queryString = [
        'form.search' => ['except' => ''],
    ];
    public function showMore(Product $product)
    {
        // dd($product);

        $this->nameProduct = $product->name;
        $this->detalle = $product->description;
        $this->imagenPath = $product->image_path;
        $this->openModal();
    }

    public function openModalP()
    {
        $this->resetValidation();
        $this->productosSeleccionados = [];
        $this->description = [];
        $this->max = [];
        $this->min = [];

        $this->openP = true;
    }
    public function closeModalP()
    {
        $this->openP = false;
        $this->reset('nameProduct', 'detalle', 'imagenPath');
    }

    public function render()
    {
        if ($this->readyToLoad) {

            // return view('livewire.clientes.modal-productos');
            $categories = Categories::all();

            $products = $this->form->readProduct();
        } else {
            $categories = [];
            $products = [];
        }
        return view('livewire.clientes.modal-productos', ['products' => $products, 'categories' => $categories]);

    }


    #[On('cliente-productos')]
    public function aceptarSeleccion()
    {
        // dd($desc);
        // dd($this->productosSeleccionados, $this->description, $this->max, $this->min);
        foreach ($this->productosSeleccionados as $id => $isSelected) {

            if ($isSelected) {
             
                $product = $this->form->getOneProduct($id);

                Session::push('productosArray', [
                    'descripcion' => $this->description[$id] ?? '',
                    'max' => $this->max[$id] ?? '',
                    'min' => $this->min[$id] ?? '',
                    'name' => $product->name,
                    // 'description' => $product->description,
                    'presentation' => $product->presentation->name,
                    'gramagge' => $product->grammage->name,
                    'gramaje' => $product->gramaje,
                    'image_path' => $product->image_path,

                    'id' => $id

                ]);
            }
        }
        // Limpiar los campos después de agregar
        $this->max =  [];
        $this->min =  [];
        $this->description =  [];
        $this->productosSeleccionados = [];

        //evento para el modal del cliente
        $this->dispatch('list-products');

        $this->closeModalP();
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
}
