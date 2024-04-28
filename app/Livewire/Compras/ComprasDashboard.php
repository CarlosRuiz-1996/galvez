<?php

namespace App\Livewire\Compras;

use Livewire\Component;
use App\Livewire\Forms\ComprasForm;
use App\Models\ComprasProductos;
use App\Models\ComprasSolicitudes;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;
class ComprasDashboard extends Component
{

    public ComprasForm $form;

    #[On('dashboard-compras')]
    public function render()
    {
        // Carbon::yesterday(); // Obtenemos la fecha de ayer
        // Carbon::yesterday()->subDays(1);// Obtenemos la fecha de antier

        $gasto = ComprasProductos::whereDate('created_at',today())->sum('total');
        $productos_hoy = Product::whereDate('created_at',today())->count();
        $solicitudes_hoy = ComprasSolicitudes::whereDate('created_at',today())->count();

        return view('livewire.compras.compras-dashboard',compact('gasto','productos_hoy','solicitudes_hoy'));
    }
}
