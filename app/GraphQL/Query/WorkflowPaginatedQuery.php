<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class WorkflowPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'workflowspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('workflowspaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'position'  => ['type' => Type::int(), 'description' => ''],
            'ficheevaluation_id'  => ['type' => Type::int(), 'description' => ''],
            'role_id'  => ['type' => Type::int(), 'description' => ''],
            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryWorkflow($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
