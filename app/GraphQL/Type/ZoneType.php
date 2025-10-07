<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;


class ZoneType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Zone',
        'description' => ''
    ];

    public function fields(): array
    {
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'designation' => ['type' => Type::string(), 'description' => ''],
                'descriptions' => ['type' => Type::string(), 'description' => ''],

                'pointdeventes' => ['type' => Type::listOf(GraphQL::type('Pointdevente')), 'description' => ''],

                'userzones' => ['type' => Type::listOf(GraphQL::type('Userzone')), 'description' => ''],
                
                // antenne
                'antenne' => ['type' => GraphQL::type('Antenne'), 'description' => ''],
                'antenne_id' => ['type' => Type::int(), 'description' => ''],

                // parent
                'parent' => ['type' => GraphQL::type('Zone'), 'description' => ''],
                'parent_id' => ['type' => Type::int(), 'description' => ''],

                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }
}
