<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('users.dashboard');
    }

    public function myProfile() {
        return view('users.my_profile');
    }

    public function update(Request $request, $id) {
        echo "Atualizando";
    }
}
