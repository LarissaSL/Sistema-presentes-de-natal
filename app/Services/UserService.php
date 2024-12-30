<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function validatedDataLogin(array $data)
    {
        return Validator::make(
            $data,
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:50',
            ],
            [
                'email.required' => 'O email precisa ser preenchido.',
                'email.email' => 'Digite um endereço de email válido.',
                'password.required' => 'A senha precisa ser preenchida.',
                'password.min' => 'A senha precisa ter no mínimo :min caracteres.',
                'password.max' => 'A senha precisa ter no máximo :max caracteres.',
            ]
        );
    }

    public static function loginUser($email, $password)
    {

        // Verificar se o usuário existe
        $user = DB::table('users')->where('email', $email)->first();

        // Se o usuário não existir ou a senha estiver incorreta
        if (!$user || !Hash::check($password, $user->password)) {
            return false;
        }

        session([
            'user' => [
                'id' => Crypt::encrypt($user->id),
                'username' => $user->name
            ]
        ]);

        return true;
    }
}
