<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TypemarchesQuery extends Query
{
    protected $attributes = [
        'name' => 'typemarches'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Typemarche'));
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::int()],
            'designation' => ['type' => Type::string()],
            'description' => ['type' => Type::string(), 'description' => ''],
            'code' => ['type' => Type::int(), 'description' => ''],
            'type' => ['type' => Type::int(), 'description' => ''],

            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryTypemarche($args);
        return $query->get();
    }
}
