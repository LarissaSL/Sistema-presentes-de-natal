<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function login(Request $request)
    {
        // Validar os campos
        $validatedData = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:50'
            ],
            [
                'email.required' => 'O email precisa ser preenchido.',
                'email.email' => 'Digite um endereço de email.',

                'password.required' => 'A senha precisa ser preenchida.',
                'password.min' => 'A senha precisa ter no minimo :min de caracteres.',
                'password.max' => 'A senha precisa ter no minimo :max de caracteres.'
            ]
        );

        // Verificar se o Usuário está no sistema

        // Retornar a devolutiva de Login

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
