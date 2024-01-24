<?php

namespace App\Livewire\Forms;

use App\Models\Carnes;
use App\Models\CarnesDetails;
use Livewire\Attributes\Rule;
use Livewire\Form;
use App\Models\ctg_carne;
use App\Models\ctg_tipo_carne;
use App\Models\Grammage;

class CarneForm extends Form
{

  public $total;

  public $gramaje_total;

  // protected $rules = [
  //   'total' => 'required',
  //   'gramaje_total' => 'required',

  // ];

  public function getAllCarne($sort, $orderBy, $list)
  {
    return Carnes::orderBy($sort, $orderBy)
    ->paginate($list);
  }

  public function getAllCtgCarnes()
  {
    return ctg_carne::orderBy('name', 'asc')->get()->toArray();
  }
  public function getAllTypeCarnes()
  {
    return ctg_tipo_carne::orderBy('id', 'asc')->get()->toArray();
  }
  public function getAllGrammage()
  {
    return Grammage::orderBy('id', 'asc')->get()->toArray();
  }

  public function store($tipo, $darivados)
  {

    // dd($darivados);
    // $this->validate();

    $carne = Carnes::create([
      'gramaje_total' => $this->total,
      'gramaje_virtual' => $this->total,
      'ctg_grammage_id' => $this->gramaje_total,
      'ctg_tipo_carnes_id' => $tipo,

    ]);

    if (count($darivados)) {
      foreach ($darivados as $darivado) {
        CarnesDetails::create([
          'gramaje_total' => $darivado['gramaje'],
          'gramaje_virtual' => $darivado['gramaje'],
          'carnes_id' => $carne->id,
          'ctg_carnes_id' => $darivado['tipo_carne'],
          'ctg_grammage_id' => $darivado['ctg'],

        ]);
      }
    }
    $this->reset();
  }
}
