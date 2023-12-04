<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;
use App\Models\User;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Cp;
use App\Models\ClienteProduct;
use App\Models\ClienteFood;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ClienteForm extends Form
{
    public $no_contrato;
    public $cliente;
    public $name;
    public $email;
    public $password = '12345678';
    public $phone;
    public $rfc;
    public $address;
    public $status_user;

    public $estado;
    public $municipio;
    public $colonias;
    public $cp;
    public $cat_cp_id;
    public $cp_invalido = "";


    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email', // Ajusta según tus necesidades
        'cp' => 'required|max:5',
        'address' => 'required',
        'cat_cp_id' => 'required',
        'cliente' => 'required',
        'rfc' => 'required',
        'phone' => 'required|max:10|min:8',
        // 'no_contrato' => 'required',

    ];



    public function validarCp()
    {
        // $cp = Cp::where('cp', 'LIKE', '%' . $cp . '%')->first();
        // $codigo = DB::select('CALL readCpByCP(?)', [$this->cp]);
        // $codigo = Cp::where('cp', 'LIKE', '%' . $this->cp . '%')->orderBy('colonia', 'desc')->get();

        $codigo = DB::select("
    SELECT a.idcp, a.colonia, b.municipio, c.estado 
    FROM cat_cp a 
    LEFT JOIN cat_estados c ON c.idestado = a.idestado
    LEFT JOIN cat_municipios b ON b.idmunicipio = a.idmunicipio AND b.idestado = c.idestado 
    WHERE cp LIKE CONCAT('%', ? , '%')
    ", [$this->cp]);
        if ($codigo) {
            $this->municipio = $codigo[0]->municipio;
            $this->estado = $codigo[0]->estado;
            $this->colonias = $codigo;
            $this->cp_invalido = "";
        } else {
            $this->cp_invalido = "Codigo postal no valido";
        }
    }


    public function store($sts)
    {

        $this->validate();

        $this->password =  bcrypt($this->password);
        $this->status_user =  $sts;

        // dd($this->no_contrato);
        // die();
        $user = User::create($this->only(['name', 'email', 'password', 'address', 'cat_cp_id', 'cliente', 'rfc', 'phone', 'no_contrato', 'status_user']));

        $user->roles()->sync(2);

        $clienteId = $user->id;

        $productos = Session::get('productosArray', []);

        if (count($productos)) {
            foreach ($productos as $producto) {

                if ($sts == 2) {
                    ClienteProduct::create([
                        'description' => $producto['descripcion'],
                        'max' => $producto['max'],
                        'min' => $producto['min'],
                        'status' => $sts,
                        'price_prod' => $producto['price'],
                        'product_id' => $producto['id'],
                        'user_id' => $clienteId,
                    ]);
                } else {
                    ClienteProduct::create([
                        'description' => $producto['descripcion'],
                        'max' => $producto['max'],
                        'min' => $producto['min'],
                        'product_id' => $producto['id'],
                        'user_id' => $clienteId,
                    ]);
                }
            }
        }
        $foods = Session::get('FoodsArray', []);
        if (count($foods)) {

            foreach ($foods as $producto) {
                ClienteFood::create([
                    'description' => $producto['descripcion'],
                    'max' => $producto['max'],
                    'min' => $producto['min'],
                    'food_id' => $producto['id'],
                    'user_id' => $clienteId,
                ]);
            }
        }



        $this->reset();
    }
}
