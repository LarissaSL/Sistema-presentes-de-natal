<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index() {
        // Buscar o Usuário
        $id = session('user.id');
        $user = UserService::getUserByDecryptedId($id);

        if (!$user) {
            return redirect()->back()->withErrors(['notFoundUser' => 'Usuário não encontrado.']);
        }

        // Buscar todos os Contatos desse usuário (Usando Query Builder)
        $contacts = DB::table('contacts')
                        ->where('user_id', $user->id) 
                        ->get()
                        ->toArray(); 


        // Carregar a View com os Contatos
        return view('contacts.index', compact('contacts'));
    
    }

    public function create() {
        return "Formulário para criar um Contato";
    }

    public function createSubmit() {
        return "Criando um Contato";
    }

    public function read($id) {
        return "Lendo um Contato";
    }

    public function update($id) {
        return "Atualizando um Contato";
    }

    public function delete($id) {
        return "Deletando um Contato";
    }
}
