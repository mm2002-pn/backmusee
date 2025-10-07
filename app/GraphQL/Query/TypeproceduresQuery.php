<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TypeproceduresQuery extends Query
{
    protected $attributes = [
        'name' => 'typeprocedures',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Typeprocedure'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryTypeprocedure($args);
        return $query->get();
    }
}
