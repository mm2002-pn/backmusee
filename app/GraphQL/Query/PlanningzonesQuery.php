<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class PlanningzonesQuery extends Query
{
    protected $attributes = [
        'name' => 'planningzones',
        'description' => '',
    ];
    public function type(): Type
    {
        return Type::listOf(GraphQL::type("Planningzone"));
    }
    public function args(): array
    {
        return
            [
            'id' => ['type' => Type::id()],
            'planning_id' => ['type' => Type::int()],
            'zone_id' => ['type' => Type::int()],
        ];
    }
    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryPlanningzone($args);
        return $query->get();
    }
}
