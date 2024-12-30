<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() {
        return view('users.dashboard');
    }

    public function read($id) {
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

    public function update(Request $request, $id) {
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
        
        if(!$statusToUpdate) {
            return redirect()->back()->withErrors(['updateFailed' => 'Falha ao alterar, tente novamente.']);
        }
        
        return redirect()->back()->with('success', 'Alterações feitas com sucesso!');
    }
}
