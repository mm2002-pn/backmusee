<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ParcourmarchesQuery extends Query
{
    protected $attributes = [
        'name' => 'parcourmarches',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Parcourmarche'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'description' => ['type' => Type::string(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryParcourmarche($args);
        return $query->get();
    }
}
