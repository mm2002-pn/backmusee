<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class AntennePaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'antennespaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('antennespaginated');
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'code' => ['type' => Type::string()],
                'designation' => ['type' => Type::string()],
                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'user_id' => ['type' => Type::int(), 'description' => ''],

                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryAntenne($args);

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->paginate($count, ['*'], 'page', $page);
    }
}
