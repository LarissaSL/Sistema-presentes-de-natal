<?php

namespace App\Services;

use App\Enums\RelationshipType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ContactService
{
    public static function createContact($userId, $name, $relationType)
    {
        try {
            DB::table('contacts')->insert([
                'name' => $name,
                'user_id' => $userId,
                'relationship_type' => $relationType,
                'created_at' => date('Y:m:d H:i:s'),
            ]);
        } catch (\Throwable $th) {
            return false;
        }

        return true;
    }

    public static function validatedDataToRegisterContact(array $data)
    {
        return Validator::make(
            $data,
            [
                'name' => 'required|max:50',
                'category' => ['required', Rule::in(RelationshipType::values())],
            ],
            [
                'name.required' => 'O nome precisa ser preenchido.',
                'name.max' => 'O nome precisa ter no máximo :max caracteres.',
                'category' => 'A categoria é obrigatória.',
                'category.in' => 'A categoria selecionada não é válida. Por favor, escolha uma das opções disponíveis.',
            ]
        );
    }

}