<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\User;
use App\Models\Cp;
use App\Models\ClienteProduct;
use App\Models\ClienteFood;
use App\Models\Cotizacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ClienteForm extends Form
{
    public $activo = false; //para ver si es un cliente nuevo o un cliente existente para la cotizacion
    public $cliente_existente; //guardo objeto del cliente para una cotizacion

    public $no_contrato;
    public $cliente;
    public $name;
    public $email;
    public $password = '12345678';
    public $phone;
    public $rfc;
    public $address;
    public $status_user;
    public $user;
    public $estado;
    public $municipio;
    public $colonias;
    public $cp;
    public $cat_cp_id;
    public $cp_invalido = "";
    public $search = "";
    public $searchP = "";
    public $seach_food = "";

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email', // Ajusta según tus necesidades |unique:users,email
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
        $this->password =  bcrypt($this->password);
        $this->status_user =  $sts;
        //si no existe activo se crea el cliente 
        //de lo contrario se consulta para obtener el cliente al que se le hace la cotizacion
        if (!$this->activo) {
            $this->validate();

            $user = User::create($this->only(['name', 'email', 'password', 'address', 'cat_cp_id', 'cliente', 'rfc', 'phone', 'no_contrato', 'status_user']));
            $user->roles()->sync(2);
        } else {
            $user = $this->cliente_existente;
        }
        $clienteId = $user->id;
        $cotizacion= "";
        //tabla de cotizacion, si es cotizacion
        if ($this->activo) {

            $cotizacion = Cotizacion::where('user_id', '=', $clienteId)
                ->where('status', '=', 1)->first();


            if (!$cotizacion) {

                Cotizacion::create([
                    'status' => 1,
                    'user_id' => $clienteId,
                ]);
            }else{
                $cotizacion->update(['updated_at'=>now()]);
            }
        }

        //guardar productos y comidas para el cliente
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
                    'status' => $sts == 2 ? $sts : 1,
                    'food_id' => $producto['id'],
                    'user_id' => $clienteId,
                ]);
            }
        }



        $this->reset();
    }


    public function getAll($sort, $orderBy, $list)
    {
        return User::role('cliente')
        ->where('status_user','=',1)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('cliente', 'like', '%' . $this->search . '%')
                    ->orWhere('rfc', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%')
                    ->orWhere('no_contrato', 'like', '%' . $this->search . '%');
            })
            ->orderBy($sort, $orderBy)
            ->paginate($list);

        //  return User::role('2')
        //  ->where('name', 'like', '%' . $this->search . '%')
        //  ->orderBy($sort, $orderBy)
        //  ->get();
    }


    public function setUser(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->address = $user->address;
        $this->cliente = $user->cliente;
        $this->rfc = $user->rfc;
        $this->phone = $user->phone;
        $this->no_contrato = $user->no_contrato;

        $cp = Cp::where('idcp', '=', $user->cat_cp_id)->first();;
        if (!$cp) {
            throw new \Exception("Código postal no válido");
        }
        $codigo = DB::select("
        SELECT a.idcp, a.colonia, b.municipio, c.estado , a.cp
        FROM cat_cp a 
        LEFT JOIN cat_estados c ON c.idestado = a.idestado
        LEFT JOIN cat_municipios b ON b.idmunicipio = a.idmunicipio AND b.idestado = c.idestado 
        WHERE cp LIKE CONCAT('%', ? , '%')
        ", [$cp->cp]);

        if (empty($codigo)) {
            throw new \Exception("Código postal no válido");
        }
        // dd($codigo[0]);

        $this->municipio = $codigo[0]->municipio;
        $this->estado = $codigo[0]->estado;
        $this->cp = $codigo[0]->cp;
        $this->cat_cp_id = $user->cat_cp_id;

        $this->colonias = $codigo;
    }



    //productos
    public function getAllProducts(User $user, $sort, $orderBy, $list)
    {


        return ClienteProduct::with(['product', 'product.presentation', 'product.grammage'])
            ->where('user_id', '=', $user->id)
            ->where('status', '=', 1)
            ->where(function ($query) {
                $query->where('min', '=', $this->searchP)
                    ->orWhere('max', '=', $this->searchP)

                    ->orWhere(function ($subquery) {
                        $subquery->whereHas('product', function ($productQuery) {
                            $productQuery->where('name', 'like', '%' . $this->searchP . '%')
                                ->orWhere('description', 'like', '%' . $this->searchP . '%');
                        })
                            ->orWhereHas('product.presentation', function ($presentationQuery) {
                                $presentationQuery->where('name', 'like', '%' . $this->searchP . '%');
                            })
                            ->orWhereHas('product.grammage', function ($grammageQuery) {
                                $grammageQuery->where('name', 'like', '%' . $this->searchP . '%');
                            });
                    });
            })
            ->orderBy('id', 'asc')
            ->paginate($list);
    }



    public function updateCliente()
    {

        $this->validate();

        $this->user->update($this->only(['name', 'email', 'address', 'cat_cp_id', 'cliente', 'rfc', 'phone', 'no_contrato']));
    }


    //editar producto ************

    public $product;
    public $max;
    public $min;
    public $description;
    public $price_prod;
    public function setProduct(ClienteProduct $product)
    {
        // dd($product);
        $this->product = $product;
        $this->max = $product['max'];
        $this->min = $product['min'];
        $this->description = $product['description'];
        $this->price_prod = $product['price_prod'];

        // dd($this->product);

    }


    public function updateClienteProd()
    {


        $this->product->update($this->only(['description', 'max', 'min', 'price_prod']));
        $this->reset('description', 'max', 'min', 'price_prod');
    }



    //platillos:

    public function getAllFood(User $user, $sort, $orderBy, $list)
    {


        return  ClienteFood::with(['food', 'food.presentation', 'food.categorie', 'food.ingredients'])
            ->where('user_id', '=', $user->id) // O el número deseado de elementos por página            
            ->where('status', '=', 1)
            ->where(function ($query) {
                $query->where('min', '=', $this->seach_food)
                    ->orWhere('max', '=', $this->seach_food)

                    ->orWhere(function ($subquery) {
                        $subquery->whereHas('food', function ($productQuery) {
                            $productQuery->where('name', 'like', '%' . $this->seach_food . '%')
                                ->orWhere('description', 'like', '%' . $this->seach_food . '%');
                        })
                            ->orWhereHas('food.presentation', function ($presentationQuery) {
                                $presentationQuery->where('name', 'like', '%' . $this->seach_food . '%');
                            })
                            ->orWhereHas('food.categorie', function ($categorieQuery) {
                                $categorieQuery->where('name', 'like', '%' . $this->seach_food . '%');
                            });
                    });
            })
            ->orderBy($sort, $orderBy)
            ->paginate($list);
    }


    public $food;
    public $price_food;

    public function setFood(ClienteFood $food)
    {
        // dd($product);
        $this->food = $food;
        $this->max = $food['max'];
        $this->min = $food['min'];
        $this->description = $food['description'];
        $this->price_food = $food['price_food'];

        // dd($this->product);

    }



    public function updateClienteFood()
    {


        $this->food->update($this->only(['description', 'max', 'min', 'price_food']));
        $this->reset('description', 'max', 'min', 'price_food');
    }
}
