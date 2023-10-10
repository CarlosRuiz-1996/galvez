<?php

use App\Http\Controllers\Admin\CatalogsController;
use App\Livewire\GestionProduct;
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


Route::get('admin/catalogos', [CatalogsController::class, 'index'])->name('catalogos');
Route::get('search/product', SearchProducts::class)->name('buscar.producto');
Route::get('gestion/product/{category?}', GestionProduct::class)->name('gestion.ctg.producto');



//rutas para livewire
use Livewire\Livewire;
Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get('/livewire/livewire.js', $handle);
});