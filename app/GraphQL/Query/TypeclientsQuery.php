<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TypeclientsQuery extends Query
{
    protected $attributes = [
        'name' => 'typeclients',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Typeclient'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],

            // designation
            'designation' => ['type' => Type::string(), 'description' => ''],
            // description
            'description' => ['type' => Type::string(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryTypeclient($root,$args);
        return $query->get();
    }
}
