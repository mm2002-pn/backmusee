<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class PlanningusersQuery extends Query
{
    protected $attributes = [
        'name' => 'planningusers',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Planninguser'));
    }


    public function args(): array
    {
        return [
            'planning_id' => ['type' => Type::int()],
            'user_id' => ['type' => Type::int()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryPlanninguser($args);
        return $query->get();
    }
}
