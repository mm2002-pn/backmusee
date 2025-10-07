<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;


class TypemarcheType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Typemarche',
        'description' => ''
    ];

    public function fields(): array
    {
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'designation' => ['type' => Type::string(), 'description' => ''],
                'description' => ['type' => Type::string(), 'description' => ''],
                'code' => ['type' => Type::int(), 'description' => ''],
                'articles' => ['type' => GraphQL::type('Article'), 'description' => ''],
                'type' => ['type' => Type::int(), 'description' => ''],

                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
                'typemarchedetails' => ['type' => Type::listOf(GraphQL::type('Typemarchedetail')), 'description' => ''],

            ];
    }
}
