<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatalogsController extends Controller
{
    public function index(){
        return view('admin.catalogos');
    }


    public function clientes(){
        return view('admin.clientes');
    }
}
