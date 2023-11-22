<?php

use App\Http\Controllers\Admin\CatalogsController;
use App\Livewire\Clientes\GestionClientes;
use App\Livewire\GestionFood;
use App\Livewire\GestionProduct;
use App\Livewire\Pedidos\Abastecimiento;
use App\Livewire\Pedidos\GestionarPedidos;
use App\Livewire\SearchFood;
use App\Livewire\SearchProducts;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('admin/catalogos', [CatalogsController::class, 'index'])->name('catalogos');
    Route::get('search/product', SearchProducts::class)->name('buscar.producto');
    Route::get('gestion/product/{category?}', GestionProduct::class)->name('gestion.ctg.producto');
    Route::get('search/food', SearchFood::class)->name('buscar.comida');
    Route::get('gestion/food/{category?}', GestionFood::class)->name('gestion.ctg.comida');

    //clientes

    Route::get('admin/clientes', [CatalogsController::class, 'clientes'])->name('clientes');
    Route::get('admin/clientes/gestion', GestionClientes::class)->name('clientes.gestion');
    Route::get('admin/abastecimiento', Abastecimiento::class)->name('clientes.abastecimiento');


    Route::get('clientes/pedidos', GestionarPedidos::class)->name('clientes.pedidos');

});

//rutas para livewire
use Livewire\Livewire;

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get('/livewire/livewire.js', $handle);
});
