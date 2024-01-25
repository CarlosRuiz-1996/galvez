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

  public function store($tipo, $derivados)
  {


    $carne = Carnes::create([
      'gramaje_total' => $this->total,
      'gramaje_virtual' => $this->total,
      'ctg_grammage_id' => $this->gramaje_total,
      'ctg_tipo_carnes_id' => $tipo,

    ]);

    if (count($derivados)) {
      foreach ($derivados as $darivado) {
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



  public function update($carne_detail)
  {


    //sacar diferencia
    $diferencia = 0;
    $mayor = 0;
    $carne = Carnes::find($carne_detail->carnes_id);

    if ($carne_detail->gramaje_total < $this->total) {

      $diferencia =  $this->total - $carne_detail->gramaje_total;
      $mayor = 1;
    } else {
      $diferencia = $carne_detail->gramaje_total - $this->total;
    }




    //reviso si se hace una suma o una resta a la cantidad total de carnes. 
    if ($mayor != 1) {
      $new = $carne->gramaje_total - $diferencia;
    } else {
      $new = $carne->gramaje_total + $diferencia;
    }

    //reviso si es gramo o kilogramo en carnes general
    if ($carne->ctg_grammage_id == 4 && $this->gramaje_total = 1) {
      $new_gramaje = 1;
    } else {
      $new_gramaje = $carne->ctg_grammage_id;
    }


    //actualizar tabla details_carnes
    $carne_detail->update(
      [
        'gramaje_total' => $this->total,
        'gramaje_virtual' => $this->total,
        'ctg_grammage_id' => $this->gramaje_total
      ]
    );
    //actualizar tabla carnes
    $carne->update([
      'gramaje_total' => $new,
      'gramaje_virtual' => $new,
      'ctg_grammage_id' => $new_gramaje

    ]);

    $this->reset();
  }

  public function updateCarne($carne, $derivados, $total)
  {

    //sacar diferencia
    $diferencia = 0;
    if ($carne->gramaje_total != $this->total) {

      if ($carne->gramaje_total < $this->total) {

        $diferencia =  $this->total - $carne->gramaje_total;
        $this->total = $carne->gramaje_total + $diferencia;

      } else {
        $diferencia = $carne->gramaje_total - $this->total;
        $this->total = $carne->gramaje_total - $diferencia;

      }
  
    } else {
      if($carne->gramaje_total<$total){
        $this->total = $carne->gramaje_total + $total;
      }

      $suma=0;
      foreach($carne->details as $detail){
        $suma +=$detail->gramaje_total;
      }
      if($carne->gramaje_total<($suma+$total)){

        $diferencia = ($suma+$total)-$carne->gramaje_total;
        $this->total = $carne->gramaje_total + $diferencia;

      }
    }


    if (!count($derivados)){
      $suma=0;
      foreach($carne->details as $detail){
        $suma +=$detail->gramaje_total;
      }

      if($this->total<$suma ){
        // break;
        return 0;
      }
    }

    //actualizar tabla details_carnes
    $carne->update(
      [
        'gramaje_total' => $this->total,
        'gramaje_virtual' => $this->total,
        'ctg_grammage_id' => $this->gramaje_total
      ]
    );

    if (count($derivados)) {
      foreach ($derivados as $darivado) {
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
    return 1;
  }
}
