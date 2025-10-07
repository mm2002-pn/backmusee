<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class PlanningequipementPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'planningequipementspaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('planningequipementspaginated');
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'planning_id' => ['type' => Type::int()],
                'equipement_id' => ['type' => Type::int()],
                'visite_id' => ['type' => Type::int()],
                'quantiterestante' => ['type' => Type::string()],


                'quantite' => ['type' => Type::string()],
                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryPlanningequipement($args);

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->paginate($count, ['*'], 'page', $page);
    }
}
