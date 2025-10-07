<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TypeaosQuery extends Query
{
    protected $attributes = [
        'name' => 'typeaos',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Typeao'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation'   => ['type' => Type::string(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryTypeao($args);
        return $query->get();
    }
}
