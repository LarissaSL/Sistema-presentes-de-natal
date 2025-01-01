<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index(Request $request) {
        // Pegando o usuário
        $userId = $request->attributes->get('user')->id;

        // Buscar todos os Contatos desse usuário (Usando Query Builder)
        $contacts = DB::table('contacts')
                        ->where('user_id', $userId) 
                        ->get()
                        ->toArray(); 


        // Carregar a View com os Contatos
        return view('contacts.listContacts', compact('contacts'));
    
    }

    public function create() {
        return view('contacts.contactRegister');
    }

    public function createSubmit(Request $request) {
        // Pegando o usuário
        $userId = $request->attributes->get('user')->id;

        // Validar os dados para criar Contato
        $validatedData = $this->contactService->validatedContactData($request->all());

        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData);
        }
        // Criar contato
        $statusToCreate = $this->contactService->createContact($userId, $request->name, $request->category);

        if (!$statusToCreate) {
            return redirect()->back()->withInput()->withErrors(['FailedToCreateContact' => 'Falha ao criar contato, tente novamente.']);
        }

        return redirect()->route('contact.listContacts')->with('success', 'Contato cadastrado com sucesso!');
    }

    public function update($id) {
        // Buscar o Contato


        // Exibir as informações do Contato


        // Retornar a view
        
        return "Atualizando o contact de id: $id";
    }

    public function updateSubmit() {
        return "Atualizando um Contato";
    }

    public function delete($id) {
        return "Deletando um Contato";
    }
}
