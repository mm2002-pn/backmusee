<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class FabricantType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Fabricant',
        'description' => 'Type pour le modèle Fournisseur',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::int(), 'description' => ''],
            'email' => ['type' => Type::string(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'code' => ['type' => Type::string(), 'description' => ''],
            'adresse' => ['type' => Type::string(), 'description' => ''],
            'telephone' => ['type' => Type::string(), 'description' => ''],
            'pay_id' => ['type' => Type::int(), 'description' => ''],
            'pay' => ['type' => GraphQL::type('Pays'), 'description' => ''],
        ];
    }
}
