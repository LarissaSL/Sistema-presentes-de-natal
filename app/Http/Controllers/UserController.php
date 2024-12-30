<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.dashboard');
    }

    public function register() {
        return view('users.register');
    }

    public function registerSubmit(Request $request) {
        // Validando os dados de Cadastro
        $validatedData = UserService::validatedDataToRegisterUser($request->all());

        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData);
        }

        // Enviando os dados para realizar cadastro
        $statusToRegister = UserService::createUser($request->name, $request->email, $request->password);

        if (!$statusToRegister){
            return redirect()->back()->withErrors(['registerFailed' => 'Falha ao cadastrar, tente novamente.']);
        }

        // Realizar o Login
        $validatedLogin = UserService::loginUser($request->email, $request->password);

        if (!$validatedLogin) {
            return redirect()->back()->withInput()->with('loginError', 'Email ou senha incorretos.');
        }

        return redirect()->route('user.dashboard');
    }

    public function read($id)
    {
        // Buscar o Usuário
        $user = UserService::getUserByDecryptedId($id);

        if (!$user) {
            return redirect()->back()->withErrors(['notFoundUser' => 'Usuário não encontrado.']);
        }

        // Enviar os dados para View
        $name = $user->name;
        $email = $user->email;

        return view('users.my_profile', compact('name', 'email'));
    }

    public function update(Request $request, $id)
    {
        // Buscar o Usuário
        $user = UserService::getUserByDecryptedId($id);

        if (!$user) {
            return redirect()->back()->withErrors(['notFoundUser' => 'Usuário não encontrado.']);
        }

        $userId = $user->id;

        // Validar os campos
        $validatedData = UserService::validatedDataToUpdateUser($request->all(), $userId);

        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData);
        }

        // Fazer o Update dos Campos
        $statusToUpdate = UserService::updatedUser($request->email, $request->name, $request->password, $userId);

        if (!$statusToUpdate) {
            return redirect()->back()->withErrors(['updateFailed' => 'Falha ao alterar, tente novamente.']);
        }

        return redirect()->back()->with('success', 'Alterações feitas com sucesso!');
    }
}
