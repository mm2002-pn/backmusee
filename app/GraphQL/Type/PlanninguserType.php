<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class PlanninguserType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Planninguser',
        'description' => 'Type pour le modèle Planninguser',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],

            'planning_id' => ['type' => Type::int()],

            'user_id' => ['type' => Type::int()],


            'user' => ['type' => GraphQL::type('User')],

            'planning' => ['type' => GraphQL::type('Planning')],
        ];
    }
}
