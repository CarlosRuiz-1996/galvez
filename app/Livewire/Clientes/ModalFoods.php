<?php

namespace App\Livewire\Clientes;



use App\Livewire\Forms\ModalFoodForm;
use Livewire\Component;
use App\Models\Product;
use App\Models\CategoriesFood;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;

class ModalFoods extends Component
{
    use WithPagination;

    public $openPL = false;
    public ModalFoodForm $form;
    public $nameProduct;
    public $detalle;
    public $imagenPath;

    public $foodsSeleccionados = [];
    public $description = [];
    public $max = [];
    public $min = [];

    //para cargar la pagina hasta que carguen los productos
    public $readyToLoad = false;
    protected $queryString = [
        'form.search' => ['except' => ''],
    ];
   

    public function openModalPL()
    {
        $this->resetValidation();
        $this->foodsSeleccionados = [];
        $this->description = [];
        $this->max = [];
        $this->min = [];

        $this->openPL = true;
    }
    public function closeModalPL()
    {
        $this->openPL = false;
        $this->reset('nameProduct', 'detalle', 'imagenPath');
    }

    public function render()
    {
        if ($this->readyToLoad) {

            // return view('livewire.clientes.modal-productos');
            $categories = CategoriesFood::all();

            $products = $this->form->readFood();
        } else {
            $categories = [];
            $products = [];
        }
        return view('livewire.clientes.modal-foods', ['foods' => $products, 'categories' => $categories]);
    }


    // #[On('cliente-productos')]
    public function aceptarSeleccion()
    {
        
        foreach ($this->foodsSeleccionados as $id => $isSelected) {

            if ($isSelected) {

                $food = $this->form->getOneProduct($id);

                Session::push('FoodsArray', [
                    'descripcion' => $this->description[$id] ?? '',
                    'max' => $this->max[$id] ?? '',
                    'min' => $this->min[$id] ?? '',
                    'name' => $food->name,
                    'presentation' => $food->presentation->name,
                    'categori' => $food->categorie->name,
                    'image_path' => $food->image_path,

                    'id' => $id

                ]);
            }
        }
        // Limpiar los campos después de agregar
        $this->max =  [];
        $this->min =  [];
        $this->description =  [];
        $this->foodsSeleccionados = [];

        //evento para el modal del cliente
        $this->dispatch('list-products');

        $this->closeModalPL();
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }

    //renderisa la tabla una ves que carga la pagina
    public function loadFoods()
    {
        $this->readyToLoad = true;
    }
}
