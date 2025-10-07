<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class PlanningproduitPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'planningproduitspaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('planningproduitspaginated');
    }

    public function args(): array
    {
        return
            [
                'id'=> ['type' => Type::int()],
                'planning_id' => ['type' => Type::int()],
                'produit_id' => ['type' => Type::int()],
                'visite_id' => ['type' => Type::int()],
                'unite_id' => ['type' => Type::int()],

                'quantite' => ['type' => Type::string()],
                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryPlanningproduit($args);

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->paginate($count, ['*'], 'page', $page);

    }


}
