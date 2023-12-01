<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
class UserController extends Controller
{
    //
    public function excel($user) 
    {
        $userModel = User::findOrFail($user);

        return Excel::download(new UsersExport($userModel), 'users.xlsx');
    }
}
