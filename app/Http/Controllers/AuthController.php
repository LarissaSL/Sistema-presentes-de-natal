<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\View;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        // Validando os dados
        $validatedDataLogin = UserService::validatedDataLogin($request->all());

        if ($validatedDataLogin->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedDataLogin);
        }

        // Pegar os dados do formulário
        $email = $request->email;
        $password = $request->password;

        // Realizar o Login
        $validatedLogin = UserService::loginUser($email, $password);

        if (!$validatedLogin) {
            return redirect()->back()->withInput()->with('loginError', 'Email ou senha incorretos.');
        }

        return redirect()->route('main.dashboard');
    }

    public function logout() {
        echo 'Fazer Logout';
    }
}
