<?php

namespace App\Http\Controllers;

use App\Services\OperationsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() {
        return view('users.dashboard');
    }

    public function myProfile($id) {
        // Receber o ID e Descriptografar
        $userId = OperationsService::decryptId($id);
    
        // Verificar se o Usuário existe
        $user = DB::table('users')->where('id', $userId)->first();
    
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
