<?php

namespace App\Livewire;

use App\Livewire\Forms\FoodForm;
use App\Models\CategoriesFood;
use App\Models\Grammage;
use App\Models\PresentationFood;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\File;

class GestionFood extends Component
{
    use WithFileUploads;
    use WithPagination;
    public FoodForm $form;

    public $category, $identificador, $image;
    public $entrada = array('5', '10', '15', '20', '50', '100');
    public $list = '10';
    public $readyToLoad = false;
    public $sort = "id";
    public $orderBy = "desc";

    //sesion para guardar datos de ingredientes
    public $ingredients = [];
    public $ingredientName;
    public $quantity;
    public $grammage;
    public $id_selectedGrammage;


    protected $queryString = [
        'list' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'orderBy' => ['except' => 'desc'],
        'form.search' => ['except' => ''],
    ];
    public $open = true;
    public $productId; //VARIABLE PARA CUANDO EDITE


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

    public function mount(CategoriesFood $category)
    {
        $this->category = $category;
        //para poder setear la imagen input
        $this->identificador = rand();
    }




    #[On('show-food')]
    public function render()
    {
        if ($this->readyToLoad) {
            $presentations = PresentationFood::all();
            $grammages = Grammage::all();

            $products = $this->form->readProductCategory($this->category->id, $this->sort, $this->orderBy, $this->list);
        } else {
            $presentations = [];
            $products = [];
            $grammages = [];
        }

        return view('livewire.gestion-food', [
            'products' => $products,
            'presentations' => $presentations,
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

    #[On('save-food')]
    public function save()
    {

        if ($this->image) {
            $this->form->image_path = $this->image->store('products'); //-la imagen se guarda con la ruta products/image.jpg
        }
        $this->form->ctg_categories_food_id = $this->category->id;

        $this->form->store($this->ingredients);
        $this->reset(['open', 'image','ingredients' ]);
        $this->identificador = rand();

        $this->dispatch('show-food');
        $this->dispatch('alert', "El platillo se creo satisfactoriamente.");
        $this->closeModal();
    }



    public function addIngredient()
    {
        $this->validate([
            'ingredientName' => 'required',
            'quantity' => 'required|numeric',
            'grammage' => 'required|numeric',
            'id_selectedGrammage' => 'required',
        ]);
        $grammage_name = $this->form->getOneGrammage($this->id_selectedGrammage);

        // Agregar los datos a la lista
        $this->ingredients[] = [
            'name' => $this->ingredientName,
            'quantity' => $this->quantity,
            'grammage' => $this->grammage,
            'grammage_name' => $grammage_name,
            'id_selectedGrammage' => $this->id_selectedGrammage,

        ];

        // Limpiar los campos después de agregar
        $this->ingredientName = '';
        $this->quantity = '';
        $this->grammage = '';
        $this->id_selectedGrammage = '';


      
        //evento para alpine
        $this->dispatch('showFlashMessage','Ingrediente agregado con éxito.');

    }


    
}
