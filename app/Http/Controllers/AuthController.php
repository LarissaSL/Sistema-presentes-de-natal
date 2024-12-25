<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AuthController extends Controller
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User(); 
    }

    public function index()
    {
        return view('index');
    }

    public function login(Request $request)
    {
        // Validando os dados
        $validatedData = User::validatedData($request->all());

        // Se a validação falhar, redireciona de volta com erros
        if ($validatedData->fails()) {
            return back()->withErrors($validatedData)->withInput();
        }

        // Pegar os dados do formulário
        $email = $request->email;
        $password = $request->password;

        // Realizar o Login
        $validatedLogin = User::loginUser($email, $password);

        if (!$validatedLogin) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Email ou senha incorretos.'); 
        }
        
        return redirect()->route('main.dashboard');

    }

    public function register()
    {
        echo 'Retornei o Formulário para registro';
    }

    public function registerSubmit()
    {
        echo 'Retornei a Submissão do Registro';
    }
}
