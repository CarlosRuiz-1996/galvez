<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;
use App\Models\Product;
use App\Models\Categories;

class ProductForm extends Form
{

    public $image_path;
    public $name;
    public $description;
    public $gramaje;
    public $grammage_id;
    public $brand_id;
    public $presentation_id;
    public $category_id;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'gramaje' => 'required',
        'grammage_id' => 'required',
        'brand_id' => 'required',
        'presentation_id' => 'required',
        'category_id' => 'required',
        'image_path' => 'required'
    ];
    public ?Product $product;
    public $seach_cat = "";
    public $seach_prod = "";
    public $search = "";

    //filtro de categoria
    public function readCategory()
    {
        $query = Categories::query();

        if (!empty($this->seach_cat)) {
            $query->where('name', 'like', '%' . $this->seach_cat . '%');
        }

        return $query->get();
    }
    //filtro de productos
    public function readProduct()
    {

        if (!empty($this->seach_prod)) {
            return  Product::where('name', 'like', '%' . $this->seach_prod . '%')->orderBy('id', 'desc')->get();
        }
    }

    public function setProduct(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->gramaje = $product->gramaje;
        $this->grammage_id = $product->grammage_id;
        $this->image_path = $product->image_path;
        $this->brand_id = $product->brand_id;
        $this->presentation_id = $product->presentation_id;
        $this->category_id = $product->category_id;
    }
    public function setProductEmpty()
    {
        $this->name = "";
        $this->description = "";
        $this->gramaje = "";
        $this->grammage_id = "";
        $this->image_path = "";
        $this->brand_id = "";
        $this->presentation_id = "";
        $this->category_id = "";
    }
     //read productos categoria
     public function readProductCategory($id, $sort, $orderBy, $list)
     {
         return Product::where('ctg_category_id', '=',$id)
             ->Where('name', 'like', '%' . $this->search . '%')
 
             ->Where('description', 'like', '%' . $this->search . '%')
             ->WhereHas('presentation', function ($query) {
                 $query->where('name', 'like', '%' . $this->search . '%');
             })
             ->WhereHas('grammage', function ($query) {
                 $query->where('name', 'like', '%' . $this->search . '%');
             })
             ->orderBy($sort, $orderBy)
             ->paginate($list);
     }
 
     //save datos nuevos
     public function store()
     {
        $this->validate();

         Product::create($this->only(['name', 'description', 'gramaje','grammage_id','brand_id', 'presentation_id', 'category_id', 'image_path']));
         $this->reset();
     }
 
 
     public function update()
     {
         $this->validate();
         $this->product->update($this->all());
         $this->reset('name', 'description', 'gramaje','grammage_id','brand_id', 'presentation_id', 'category_id', 'image_path');
     }
 
 
     public function delete()
     {
         $this->product->delete();
         $this->reset();
     }
}
