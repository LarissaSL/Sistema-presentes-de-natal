<?php

namespace App\Http\Middleware;

use App\Services\UserService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Buscar o usuário
        $id = session('user.id');
        $user = UserService::getUserByDecryptedId($id);

        if (!$user) {
            return redirect()->back()->withErrors(['notFoundUser' => 'Usuário não encontrado.']);
        }

        // Criando o atributo
        $request->attributes->set('user', $user);

        return $next($request);
    }
}
