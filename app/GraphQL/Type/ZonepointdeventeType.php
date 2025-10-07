<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;


class ZonepointdeventeType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Zonepointdevente',
        'description' => ''
    ];

    public function fields(): array
    {
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'zone' => ['type' => GraphQL::type('Zone'), 'description' => ''],
                'zone_id' => ['type' => Type::int()],
                'pointdevente_id' => ['type' => Type::int()],

                'pointdevente' => ['type' => GraphQL::type('Pointdevente'), 'description' => ''],
                
                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }
}
