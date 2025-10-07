<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DetailcommandeType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Detailcommande',
        'description' => 'Type pour le modèle Detailcommande',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'article_id' => ['type' => Type::int(), 'description' => ''],
            'quantite' => ['type' => Type::int(), 'description' => ''],
            'prix' => ['type' => Type::int(), 'description' => ''],
            'avg' => ['type' => Type::int(), 'description' => ''],
            'commande_id' => ['type' => Type::int(), 'description' => ''],

            'article' => ['type' => GraphQL::type('Article'), 'description' => ''],
            'commande' => ['type' => GraphQL::type('Commande'), 'description' => ''],
        ];
    }
}
