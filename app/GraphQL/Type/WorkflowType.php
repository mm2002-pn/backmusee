<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class WorkflowType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Workflow',
        'description' => 'Type pour le modèle Workflow',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'position'  => ['type' => Type::int(), 'description' => ''],
            'ficheevaluation_id'  => ['type' => Type::int(), 'description' => ''],
            'role_id'  => ['type' =>Type::int(), 'description' => ''],

            'role' => ['type' => GraphQL::type('Role'), 'description' => ''],
            'ficheevaluation' => ['type' => GraphQL::type('Ficheevaluation'), 'description' => ''],
        ];
    }
}
