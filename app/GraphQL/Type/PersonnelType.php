<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class PersonnelType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Personnel',
        'description' => 'Type pour le modèle Personnel',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'nom' => ['type' => Type::string(), 'description' => ''],
            'prenom' => ['type' => Type::string(), 'description' => ''],
            'poste' => ['type' => Type::string(), 'description' => ''],
            'telephone' => ['type' => Type::string(), 'description' => ''],

            'user' => ['type' => GraphQL::type('User'), 'description' => ''],
            'user_id' => ['type' => Type::int(), 'description' => ''],
        ];
    }
}
