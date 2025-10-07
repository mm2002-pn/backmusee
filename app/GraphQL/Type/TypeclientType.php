<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TypeclientType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Typeclient',
        'description' => 'Type pour le modèle Typeclient',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            // designation
            'designation' => ['type' => Type::string(), 'description' => ''],
            // description
            'description' => ['type' => Type::string(), 'description' => ''],
        ];
    }
}
