<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class HistogrammebestclientPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'histogrammebestclientspaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('histogrammebestclientspaginated');
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'intitule' => ['type' => Type::string(), 'description' => ''],
                'ca' => ['type' => Type::float(), 'description' => ''],
                'date' => ['type' => Type::string(), 'description' => ''],
                'datefin' => ['type' => Type::string(), 'description' => ''],
                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryHistogrammebestclient($args);

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->paginate($count, ['*'], 'page', $page);
    }
}
