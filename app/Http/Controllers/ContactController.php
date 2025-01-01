<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
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
        return view('contacts.listContacts', compact('contacts'));
    
    }

    public function create() {
        return view('contacts.contactRegister');
    }

    public function createSubmit(Request $request) {
        // Buscar o usuário
        $id = session('user.id');
        $user = UserService::getUserByDecryptedId($id);

        if (!$user) {
            return redirect()->back()->withErrors(['notFoundUser' => 'Usuário não encontrado.']);
        }

        // Validar os dados para criar Contato
        $validatedData = ContactService::validatedContactData($request->all());

        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData);
        }
        // Criar contato
        $statusToCreate = ContactService::createContact($user->id, $request->name, $request->category);

        if (!$statusToCreate) {
            return redirect()->back()->withInput()->withErrors(['FailedToCreateContact' => 'Falha ao criar contato, tente novamente.']);
        }

        return redirect()->route('contact.listContacts')->with('success', 'Contato cadastrado com sucesso!');
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
