<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class FabricantPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'fabricantspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('fabricantspaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::int(), 'description' => ''],
            'email' => ['type' => Type::string(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'code' => ['type' => Type::string(), 'description' => ''],
            'adresse' => ['type' => Type::string(), 'description' => ''],
            'telephone' => ['type' => Type::string(), 'description' => ''],
            'pay_id' => ['type' => Type::int(), 'description' => ''],
            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryFabricant($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
