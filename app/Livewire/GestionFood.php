<?php

namespace App\Livewire;

use App\Livewire\Forms\FoodForm;
use App\Models\CategoriesFood;
use App\Models\Food;
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
    public $cantidad;
    public $gramaje;
    public $ctg_grammage_id;
    public $grammage_name;
    public $ingredientesEliminados; //variable para cuando se edita desde la bd
    protected $queryString = [
        'list' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'orderBy' => ['except' => 'desc'],
        'form.search' => ['except' => ''],
    ];
    public $open = false;
    public $foodId; //VARIABLE PARA CUANDO EDITE


    public function create()
    {
        $this->reset(['image', 'foodId', 'ingredientesEliminados', 'ingredients']);
        $this->form->setFoodEmpty();
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
            $this->form->image_path = $this->image->store('foods'); //-la imagen se guarda con la ruta products/image.jpg
        }
        $this->form->ctg_categories_food_id = $this->category->id;

        $this->form->store($this->ingredients);
        $this->reset(['open', 'image', 'ingredients']);
        $this->identificador = rand();

        $this->dispatch('show-food');
        $this->dispatch('alert', "El platillo se creo satisfactoriamente.");
        $this->closeModal();
    }

    public function edit(Food $food)
    {
        $this->form->setFood($food);
        $this->foodId = $food->id;
        $this->ingredients = $food->ingredients->all();

        $this->openModal();
    }

    #[On('update-food')]
    public function update()
    {
        dd($this->image);
        if ($this->image) {
            File::delete([$this->form->image_path]);
            $this->form->image_path = $this->image->store('foods');
        }
        $this->form->update($this->ingredients, $this->ingredientesEliminados, $this->foodId);

        $this->reset('image', 'foodId', 'ingredientesEliminados', 'ingredients');
        $this->identificador = rand();
        $this->dispatch('show-food');
        $this->dispatch('alert', "El platillo se actializo satisfactoriamente.");
        $this->closeModal();
    }

    //ingredientes geston add
    public function addIngredient()
    {
        $this->validate([
            'ingredientName' => 'required',
            'cantidad' => 'required|numeric',
            'gramaje' => 'required|numeric',
            'ctg_grammage_id' => 'required',
        ]);
        $this->grammage_name = $this->form->getOneGrammage($this->ctg_grammage_id);

        // Agregar los datos a la lista
        $this->ingredients[] = [
            'name' => $this->ingredientName,
            'cantidad' => $this->cantidad,
            'gramaje' => $this->gramaje,
            'grammage_name' => $this->grammage_name->name,
            'ctg_grammage_id' => $this->ctg_grammage_id,
        ];

        // Limpiar los campos después de agregar
        $this->ingredientName = '';
        $this->cantidad = '';
        $this->gramaje = '';
        $this->ctg_grammage_id = '';



        //evento para alpine
        $this->dispatch('showFlashMessage', 'Ingrediente agregado con éxito.');
    }
    //ingredientes geston delete
    public function deleteIngredient($index)
    {
        if (isset($this->ingredients[$index])) {
            $ingredienteEliminado = $this->ingredients[$index];

            unset($this->ingredients[$index]);
            $this->ingredients = array_values($this->ingredients); // Reindexar el arreglo
            $this->ingredientesEliminados[] = $ingredienteEliminado['id'];
        }
    }
}
