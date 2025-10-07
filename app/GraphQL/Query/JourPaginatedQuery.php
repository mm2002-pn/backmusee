<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Arr;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class JourPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'jourspaginated',
        'description' => '',
    ];

    public function type(): Type
    {
        return GraphQL::type("jourspaginated");
    }
    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::nonNull(Type::int())],
                'name' => ['type' => Type::string()],
                'jour_id' => ['type' => Type::int()],
                
        ];
    }
    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryJour($args);
        $count = Arr::get($args, 'count', 30);
        $page = Arr::get($args, 'page', 1);
        return $query->orderBy('id', 'desc')->paginate($count, ['*'], 'page', $page);

    }
}
