<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;


class AxeType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Axe',
        'description' => ''
    ];

    public function fields(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'designation' => ['type' => Type::string()],
                'code' => ['type' => Type::string()],
                'description' => ['type' => Type::string(), 'description' => ''],
                'province_id' => ['type' => Type::int(), 'description' => ''],
                'province' => ['type' => GraphQL::type('Province'), 'description' => ''],
                'axetonnages' => ['type' => Type::listOf(GraphQL::type('Axetonnage')), 'description' => ''],

                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }
}
