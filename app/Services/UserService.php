<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function createUser($name, $email, $password) {
        try {
            DB::table('users')->insert([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'created_at' => date('Y:m:d H:i:s'),
            ]);
        } catch (\Throwable $th) {
            return false;
        }

        return true;
    }
    
    public static function getUserByDecryptedId($encryptedId)
    {
        // Receber o ID e Descriptografar
        $userId = OperationsService::decryptId($encryptedId);

        // Verificar se o Usuário existe
        $user = DB::table('users')->where('id', $userId)->first();

        return $user;
    }

    public static function updatedUser($email, $name, $password, $userId)
    {
        try {
            DB::table('users')
            ->where('id', $userId)
            ->update([
                'updated_at' => date('Y:m:d H:i:s'),
                'email' => $email,
                'name' => $name,
                'password' => $password ? bcrypt($password) : DB::raw('password'),
            ]);
        } catch (\Throwable $th) {
            return false;
        }

        session(['user.username' => $name]);

        return true;
    }

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

    public static function validatedDataToUpdateUser(array $data, $userId)
    {
        return Validator::make(
            $data,
            [
                'name' => 'required|max:50',
                'email' => 'required|email|unique:users,email,' . $userId,
                'password' => 'nullable|min:6|max:50',
                'passwordConfirmed' => 'nullable|same:password|min:6|max:50',
            ],
            [
                'name.required' => 'O nome precisa ser preenchido.',
                'name.max' => 'O nome precisa ter no máximo :max caracteres.',
                'email.required' => 'O email precisa ser preenchido.',
                'email.email' => 'Digite um endereço de email válido.',
                'email.unique' => 'Endereço de email já está em uso.',
                'password.required' => 'A senha precisa ser preenchida.',
                'password.min' => 'A senha precisa ter no mínimo :min caracteres.',
                'password.max' => 'A senha precisa ter no máximo :max caracteres.',
                'passwordConfirmed.same' => 'A confirmação da senha precisa ser igual à senha.',
                'passwordConfirmed.min' => 'A confirmação da senha precisa ter no mínimo :min caracteres.',
                'passwordConfirmed.max' => 'A confirmação da senha precisa ter no máximo :max caracteres.',
            ]
        );
    }

    public static function validatedDataToRegisterUser(array $data)
    {
        return Validator::make(
            $data,
            [
                'name' => 'required|max:50',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:50',
                'passwordConfirmed' => 'required|same:password|min:6|max:50',
            ],
            [
                'name.required' => 'O nome precisa ser preenchido.',
                'name.max' => 'O nome precisa ter no máximo :max caracteres.',
                'email.required' => 'O email precisa ser preenchido.',
                'email.email' => 'Digite um endereço de email válido.',
                'email.unique' => 'Endereço de email já está em uso.',
                'password.required' => 'A senha precisa ser preenchida.',
                'password.min' => 'A senha precisa ter no mínimo :min caracteres.',
                'password.max' => 'A senha precisa ter no máximo :max caracteres.',
                'passwordConfirmed.required' => 'A confirmação da senha precisa ser preenchida.',
                'passwordConfirmed.same' => 'A confirmação da senha precisa ser igual à senha.',
                'passwordConfirmed.min' => 'A confirmação da senha precisa ter no mínimo :min caracteres.',
                'passwordConfirmed.max' => 'A confirmação da senha precisa ter no máximo :max caracteres.',
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
