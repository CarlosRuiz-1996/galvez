<?php

namespace App\Livewire\Forms;

use App\Models\ClienteProduct;
use App\Models\Product;
use Livewire\Attributes\Rule;
use Livewire\Form;

class AlmacenForm extends Form
{
    public $search = "";
    public $product;
    public $name;
    public $stock;
    public $stock_min;


    public function readProducts($sort, $orderBy, $list)
    {

        return Product::where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhere('gramaje', 'like', '%' . $this->search . '%');
            })
            ->WhereHas('presentation', function ($query) {
                $query->orWhere('name', 'like', '%' . $this->search . '%');
            })


            ->orderBy($sort, $orderBy)
            ->paginate($list);
    }

    public function update()
    {
        $this->product->update($this->only('stock','stock_min'));
        $this->reset('name', 'product', 'stock','stock_min');
    }
}
