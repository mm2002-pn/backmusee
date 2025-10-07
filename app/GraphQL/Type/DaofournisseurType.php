<?php

namespace App\GraphQL\Type;

use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DaofournisseurType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Daofournisseur',
        'description' => 'Type pour le modèle DA',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'fournisseur_id' => ['type' => Type::int(), 'description' => ''],
            'da_id' => ['type' => Type::int(), 'description' => ''],
            'da' => ['type' => GraphQL::type('Da'), 'description' => ''],
            'fournisseur' => ['type' => GraphQL::type('Fournisseur'), 'description' => '']

        ];
    }

}
