<?php

namespace App\Livewire\Forms;

use App\Models\ComprasProductos;
use App\Models\ComprasSolicitudes;
use App\Models\Product;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ComprasForm extends Form
{

    public $search = "";
    public $image_path;
    public $name;
    public $description;
    public $gramaje;
    public $ctg_grammage_id;
    public $ctg_brand_id;
    public $ctg_presentation_id;
    public $ctg_category_id;
    public $stock = 0;
    public $price = 0;
    public $total = 0;
    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'gramaje' => 'required',
        'ctg_grammage_id' => 'required',
        'ctg_brand_id' => 'required',
        'ctg_presentation_id' => 'required',
        'ctg_category_id' => 'required',
        'image_path' => 'required'
    ];
    //listar productos 
    public function readProduct($sort, $orderBy, $list)
    {
        return Product::where(function ($query) {
            // $query->where('ctg_category_id', $id)
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


    public function setProductEmpty()
    {
        $this->name = "";
        $this->description = "";
        $this->gramaje = "";
        $this->ctg_grammage_id = "";
        $this->image_path = "";
        $this->ctg_brand_id = "";
        $this->ctg_presentation_id = "";
        $this->ctg_category_id = "";
    }


    //save datos nuevos
    public function store()
    {

        try {
            DB::beginTransaction();
            $this->validate();

            $producto = Product::create($this->only([
                'name', 'description', 'gramaje', 'ctg_grammage_id', 'ctg_brand_id', 'ctg_presentation_id',
                'ctg_category_id', 'price', 'stock', 'image_path'
            ]));

            $user_id = auth()->user()->id;
            ComprasProductos::create([
                'product_id' => $producto->id,
                'cantidad' => $this->stock,
                'precio'=> $this->price,
                'total'=> $this->total,
                'user_id'=>$user_id
            ]);


            DB::commit();
            $this->reset();
            return 1;
        } catch (\Exception $e) {
            $this->validate();
            DB::rollBack();
            Log::error('No se pudo completar la solicitud: ' . $e->getMessage());
            Log::info('Info: ' . $e);
            return 0;
        }
    }


    public function Solicitudes(){
        // return ComprasSolicitudes::where('status',1)->orderBy('id','DESC')->paginate(10);

        //  return ComprasSolicitudes::with(['producto'])
        //  ->select('product_id', DB::raw('SUM(cantidad) as total_cantidad'), DB::raw('MAX(urgencia) as urgencia'), DB::raw('MAX(mensaje) as mensaje'), DB::raw('MAX(created_at) as created_at'))
        //  ->where('status', 1)
        // ->groupBy('product_id')
        // ->orderBy('id', 'DESC')
        // ->paginate(10);

        return ComprasSolicitudes::select('product_id','user_id', DB::raw('SUM(cantidad) as total_cantidad'),
        DB::raw('MAX(urgencia) as urgencia'), DB::raw('MAX(mensaje) as mensaje'), DB::raw('MAX(created_at) as created_at')
        )
        ->where('status', 1)
        ->groupBy('product_id','user_id')
        ->orderBy('id', 'DESC')
        ->paginate(10);

    
    }



    //save datos nuevos
    public function ResolverSolicitud(Product $producto)
    {

        try {
            DB::beginTransaction();


            //actualizo el stock del producto
            $producto->stock =  $producto->stock+$this->stock;
            $producto->save();


            ComprasProductos::create([
                'product_id' => $producto->id,
                'cantidad' => $this->stock,
                'precio'=> $this->price,
                'total'=> $this->total,
                'user_id'=>auth()->user()->id
            ]);


            ComprasSolicitudes::where('status','=',1)->where('product_id',$producto->id)->update(['status'=>2]);


            DB::commit();
            $this->reset();
            return 1;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('No se pudo completar la solicitud: ' . $e->getMessage());
            Log::info('Info: ' . $e);
            return 0;
        }
    }
}
