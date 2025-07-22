<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function list(){

        $users = User::with('roles')->get(); //forma para obtener los roles incluidos no sirve all para eso

        return view("Usuarios.listUsuarios", compact("users"));
    }


}
