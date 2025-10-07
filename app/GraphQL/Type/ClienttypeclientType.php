<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ClienttypeclientType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Clienttypeclient',
        'description' => 'Type pour le modèle Clienttypeclient',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'client_id' => ['type' => Type::int(), 'description' => ''],
            'typeclient_id' => ['type' => Type::int(), 'description' => ''],
            'compte' => ['type' => Type::string(), 'description' => ''],

            'client' => ['type' => GraphQL::type('Client'), 'description' => ''],
            'typeclient' => ['type' => GraphQL::type('Typeclient'), 'description' => ''],
        ];
    }
}
