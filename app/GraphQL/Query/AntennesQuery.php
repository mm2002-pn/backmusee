<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AntennesQuery extends Query
{
    protected $attributes = [
        'name' => 'antennes'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Antenne'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'designation' => ['type' => Type::string()],
                'code' => ['type' => Type::string()],
                'user_id' => ['type' => Type::int(), 'description' => ''],

                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],



            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryAntenne($args);

        return $query->get();
    }
}
