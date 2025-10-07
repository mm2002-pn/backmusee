<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class PlanningproduitsQuery extends Query
{
    protected $attributes = [
        'name' => 'planningproduits'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Planningproduit'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'planning_id' => ['type' => Type::int()],
                'produit_id' => ['type' => Type::int()],
                'quantite' => ['type' => Type::string()],
                'unite_id' => ['type' => Type::int()],

                'visite_id' => ['type' => Type::int()],
                'date' => ['type' => Type::string(), 'description' => ''],
                'datefin' => ['type' => Type::string(), 'description' => ''],
                'commercial_id' => ['type' => Type::int()],

                'client_id' => ['type' => Type::int()],

                'quantiterestante' => ['type' => Type::string()],

                'est_activer' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryPlanningproduit($args);

        return $query->get()->each(function ($item) use ($args) {
            $item->setAttribute('graphql_args', $args);
        });
    }
}
