<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AofournisseurType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Aofournisseur',
        'description' => 'Type pour le modèle Aofournisseur',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'ao_id' => ['type' => Type::id(), 'description' => ''],
            'fournisseur_id' => ['type' => Type::id(), 'description' => ''],
            'ao' => ['type' => GraphQL::type('Ao'), 'description' => ''],
            'fournisseur' => ['type' => GraphQL::type('Fournisseur'), 'description' => ''],
        ];
    }
}
