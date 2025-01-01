<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('users.dashboard');
    }

    public function register() {
        return view('users.register');
    }

    public function registerSubmit(Request $request) {
        // Validando os dados de Cadastro
        $validatedData = $this->userService->validatedUserDataToRegister($request->all());

        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData);
        }

        // Enviando os dados para realizar cadastro
        $statusToRegister = $this->userService->createUser($request->name, $request->email, $request->password);

        if (!$statusToRegister){
            return redirect()->back()->withErrors(['registerFailed' => 'Falha ao cadastrar, tente novamente.']);
        }

        // Realizar o Login
        $validatedLogin = $this->userService->loginUser($request->email, $request->password);

        if (!$validatedLogin) {
            return redirect()->back()->withInput()->with('loginError', 'Email ou senha incorretos.');
        }

        return redirect()->route('user.dashboard');
    }

    public function read(Request $request)
    {
        // Buscar o Usuário
        $user = $request->attributes->get('user');

        // Enviar os dados para View
        $name = $user->name;
        $email = $user->email;

        return view('users.my_profile', compact('name', 'email'));
    }

    public function update(Request $request)
    {
        // Pegar o Usuário
        $userId = $request->attributes->get('user')->id;

        // Validar os campos
        $validatedData = $this->userService->validatedUserDataToUpdate($request->all(), $userId);

        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData);
        }

        // Fazer o Update dos Campos
        $statusToUpdate = $this->userService->updatedUser($request->email, $request->name, $request->password, $userId);

        if (!$statusToUpdate) {
            return redirect()->back()->withErrors(['updateFailed' => 'Falha ao alterar, tente novamente.']);
        }

        return redirect()->back()->with('success', 'Alterações feitas com sucesso!');
    }

    public function delete(Request $request) {
        // Pegar o Usuário
        $userId = $request->attributes->get('user')->id;

        // Deletando
        DB::table('users')->where('id', $userId)->delete();

        return redirect()->route('auth.logout');
    }
}
