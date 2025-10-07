<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class WorkflowsQuery extends Query
{
    protected $attributes = [
        'name' => 'workflows',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Workflow'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'position'  => ['type' => Type::int(), 'description' => ''],
            'ficheevaluation_id'  => ['type' => Type::int(), 'description' => ''],
            'role_id'  => ['type' => Type::int(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryWorkflow($args);
        return $query->get();
    }
}
