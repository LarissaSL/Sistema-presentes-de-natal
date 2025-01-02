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

    public function index(Request $request)
    {
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

    public function create()
    {
        return view('contacts.contactRegister');
    }

    public function createSubmit(Request $request)
    {
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

    public function update(Request $request)
    {
        // Pegando contato
        $contact = $request->attributes->get('contact');

        // Retornar a view exibindo Nome e Categoria
        $contactName = $contact->name;
        $contactRelationshipType = $contact->relationship_type;

        return view('contacts.contactUpdate', compact('contactName', 'contactRelationshipType'));
    }

    public function updateSubmit(Request $request)
    {
        // Pegando contato
        $contact = $request->attributes->get('contact');

        // Validar os dados de atualização
        $validatedData = $this->contactService->validatedContactData($request->all());
        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData);
        }

        // Atualizar
        $statusToUpdate = $this->contactService->updateContact($contact->id, $request->name, $request->category);
        if (!$statusToUpdate) {
            return redirect()->back()->withErrors(['updateFailed' => 'Falha ao alterar, tente novamente.']);
        }

        // Retornar
        return redirect()->route('contact.listContacts')->with('success', 'Alterações feitas com sucesso!');
    }

    public function delete(Request $request)
    {
        // Pegando contato
        $contact = $request->attributes->get('contact');
        $contactName = $contact->name;
        $contactRelationshipType = $contact->relationship_type;
        $contactId = $contact->id;

        // Mostrar a qtd de presentes vinculados a esse Contato
        $gifts = DB::table('gifts')
            ->where('contact_id', $contactId)
            ->get()
            ->toArray();

        // Enviar a view
        return view('contacts.contactConfirmationDelete', compact('contactId','contactName', 'contactRelationshipType', 'gifts'));
    }

    public function deleteSubmit(Request $request)
    {
        // Pegando contato
        $contact = $request->attributes->get('contact');

        // Deletando os presentes e contato
        DB::table('gifts')->where('contact_id', $contact->id)->delete();
        DB::table('contacts')->where('id', $contact->id)->delete();

        return redirect()->route('contact.listContacts')->with('success', 'Contato excluido com sucesso!');
    }
}
