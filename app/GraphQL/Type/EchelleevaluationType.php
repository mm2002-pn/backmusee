<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class EchelleevaluationType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Echelleevaluation',
        'description' => 'Type pour le modèle Echelleevaluation',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'critere_id' => ['type' => Type::int(), 'description' => ''],
            'min' => ['type' => Type::float(), 'description' => ''],
            'max' => ['type' => Type::float(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'ordre' => ['type' => Type::int(), 'description' => ''],
            'created_at' => ['type' => Type::string(), 'description' => ''],
            'updated_at' => ['type' => Type::string(), 'description' => ''],
            'points' => ['type' => Type::float(), 'description' => ''],
            // Relation avec le type Critere
            'critere' => [
                'type' => GraphQL::type('Critere'),
                'description' => 'Le critère associé à cette échelle d\'évaluation',
            ],
        ];
    }
}
