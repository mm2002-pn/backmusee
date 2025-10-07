<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class FournisseurattachementType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Fournisseurattachement',
        'description' => 'Type pour le modèle Fournisseurattachement',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            // Ajouter d'autres champs ici
            'fournisseur_id' => ['type' => Type::id(), 'description' => ''],
            'dossierfournisseur_id' => ['type' => Type::id(), 'description' => ''],

            'fournisseur' => ['type' => GraphQL::type('Fournisseur'), 'description' => ''],

            'fichierfournisseur' => ['type' => GraphQL::type('Fichierfournisseur'), 'description' => ''],
        ];
    }
}
