<?php

namespace App\Http\Middleware;

use App\Services\ContactService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckContact
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('id');
        
        // Buscar o contato
        $contact = ContactService::getContactByDecryptedId($id);

        if (!$contact) {
            return redirect()->route('contact.listContacts')->withErrors(['contactNotFound' => 'Contato não encontrado.']);
        }

        // Criando o atributo
        $request->attributes->set('contact', $contact);

        return $next($request);
    }
}
