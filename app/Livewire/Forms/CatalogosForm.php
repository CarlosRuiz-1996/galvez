<?php

namespace App\Livewire\Forms;

use App\Models\Brand;
use Livewire\Attributes\Rule;
use Livewire\Form;

class CatalogosForm extends Form
{
    public $search;
    public function getAllBrands($sort, $orderBy, $list)
    {
        return  Brand::where('name','like','%'.$this->search.'%')
        ->orderBy($sort, $orderBy)
        ->paginate($list);
    }
}
