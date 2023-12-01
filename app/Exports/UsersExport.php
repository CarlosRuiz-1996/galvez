<?php

namespace App\Exports;

use App\Models\ClienteProduct;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
class UsersExport implements FromView
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function view(): View
    {

        return view('exports_templates.cotizacion_excel_admin', [
            'user' => $this->user,
            'products'=>ClienteProduct::where('user_id','=',$this->user->id)->get()
        ]);
    }
}
