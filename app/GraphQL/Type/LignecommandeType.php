<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class LignecommandeType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Lignecommande',
        'description' => 'Type pour le modèle Lignecommande',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'article_id' => ['type' => Type::int(), 'description' => ''],
            'quantite' => ['type' => Type::int(), 'description' => ''],
            'prix' => ['type' => Type::int(), 'description' => ''],
            'avg' => ['type' => Type::int(), 'description' => ''],
            'article' => ['type' => GraphQL::type('Article'), 'description' => ''],
            'programme' => ['type' => GraphQL::type('Programme'), 'description' => ''],
            'campagne' => ['type' => GraphQL::type('Campagne'), 'description' => ''],
            'programme_id' => ['type' => Type::int(), 'description' => ''],
            'campagne_id' => ['type' => Type::int(), 'description' => ''],
        ];
    }
}
