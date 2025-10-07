<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CritereType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Critere',
        'description' => 'Type pour le modèle Critere',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'description' => ['type' => Type::string(), 'description' => ''],
            'points' => ['type' => Type::float(), 'description' => ''],
            'created_at' => ['type' => Type::string(), 'description' => ''],
            'updated_at' => ['type' => Type::string(), 'description' => ''],
            'echelleevaluations' => [
                'type' => Type::listOf(GraphQL::type('Echelleevaluation')),
                'description' => 'Liste des échelles d\'évaluation associées',
            ],
        ];
    }
}
