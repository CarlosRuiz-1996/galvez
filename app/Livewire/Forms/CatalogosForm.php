<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;

use Livewire\Form;

class CatalogosForm extends Form
{
    #[Rule('required')]
    public $name;
    public $image_path;

    public $ctg;
    public $search;
    public function getAllCtg($sort, $orderBy, $list)
    {


        return  $this->ctg->model_type::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($sort, $orderBy)
            ->paginate($list);
    }


    //save datos nuevos
    public function store($imagen_existe)
    {
        // 
        $this->validate();
        $data = [
            'name' => $this->name,
        ];
        if ($imagen_existe) {
            $data['image_path'] = $this->image_path;
        }

        $this->ctg->model_type::create($data);

    }

    public $model;
    //editar 
    public function setCatalogo($ctg)
    {
        //convierto mi array en una instancia de mi modelo de mi ctg
        $modelName = $this->ctg->model_type;
        $modelInstance = app()->make($modelName); 
        
        if ($modelInstance instanceof \Illuminate\Database\Eloquent\Model) {
            $this->model = $modelInstance->find($ctg['id']);
        }
        $this->name = $this->model->name;
        $this->image_path = $this->model->image_path?? '';
      
    }
    //actualiza
    public function update($imagen_existe)
    {
       
        $this->validate();
        $data = [
            'name' => $this->name,
        ];
        if ($imagen_existe) {
            $data['image_path'] = $this->image_path;
        }
        $this->model->update($data);
        $this->reset('name','image_path');
    }


    public function delete()
    {
       
        $this->model->update(['status'=>0]);
        // $this->reset();
    }

    public function reactive()
    {
       
        $this->model->update(['status'=>1]);
        // $this->reset();
    }
}
