<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('users.dashboard');
    }

    public function myProfile($id) {
        $user = UserService::getUserByDecryptedId($id);
    
        if (!$user) {
            return redirect()->back()->withErrors(['notFoundUser' => 'Usuário não encontrado.']);
        } 
    
        // Enviar os dados para View
        $name = $user->name;
        $email = $user->email;
    
        return view('users.my_profile', compact('name', 'email'));
    }

    public function update(Request $request, $id) {
        // Receber o ID e Descriptografar
        echo $id;

        // Verificar se o Usuario existe

        // Fazer o Update dos Campos

        // Notificar o usuario em caso de Sucesso

        echo "Atualizando";
    }
}
