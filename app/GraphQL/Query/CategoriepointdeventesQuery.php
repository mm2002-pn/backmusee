<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CategoriepointdeventesQuery extends Query
{
    protected $attributes = [
        'name' => 'categoriepointdeventes'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Categoriepointdevente'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'designation' => ['type' => Type::string()],
                'description' => ['type' => Type::string()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryCategoriepointdevente($args);

        return $query->get();
    }
}
