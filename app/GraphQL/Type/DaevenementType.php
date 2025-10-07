<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DaevenementType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Daevenement',
        'description' => 'Type pour le modèle Daevenement',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'da_id' => ['type' => Type::int(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'date' => ['type' => Type::string(), 'description' => ''],

            'da' => [
                'type' => GraphQL::type('Da'),
            ],
        ];
    }
}
