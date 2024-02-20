<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogos;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CatalogsController extends Controller
{
    public function index(){
        $catalogos = Catalogos::all();
        return view('admin.catalogos',compact('catalogos'));
    }


    public function clientes(){
        
        return view('admin.clientes');
    }
}
