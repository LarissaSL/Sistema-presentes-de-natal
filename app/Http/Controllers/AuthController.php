<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function login()  {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        // Validando os dados
        $validatedDataLogin = $this->userService->validatedLoginData($request->all());

        if ($validatedDataLogin->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedDataLogin);
        }

        // Pegar os dados do formulário
        $email = $request->email;
        $password = $request->password;

        // Realizar o Login
        $validatedLogin = $this->userService->loginUser($email, $password);

        if (!$validatedLogin) {
            return redirect()->back()->withInput()->with('loginError', 'Email ou senha incorretos.');
        }

        return redirect()->route('user.dashboard');
    }

    public function logout() {
        session()->forget('user');
        return redirect()->route('main.index');
    }
}
