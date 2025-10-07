<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ScorefournisseurType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Scorefournisseur',
        'description' => 'Type pour le modèle Scorefournisseur',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'score' => ['type' => Type::int(), 'description' => ''],
            'fournisseur_id' => ['type' => Type::id(), 'description' => ''],
            'annee' => ['type' => Type::string(), 'description' => ''],


            'fournisseur' => [
                'type' => GraphQL::type('Fournisseur'),
            ],
        ];
    }
}
