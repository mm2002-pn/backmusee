<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class PlanninguserPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'planninguserspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('planninguserspaginated');
    }

    public function args(): array
    {
        return [
            'planning_id' => ['type' => Type::int()],
            'user_id' => ['type' => Type::int()],
            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryPlanninguser($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
