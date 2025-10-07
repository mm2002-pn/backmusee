<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class ProvincePaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'provincespaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('provincespaginated');
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'province' => ['type' => Type::string()],
                'distance' => ['type' => Type::int(), 'description' => ''],
                'code' => ['type' => Type::string(), 'description' => ''],

                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryProvince($args);

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->paginate($count, ['*'], 'page', $page);
    }
}
