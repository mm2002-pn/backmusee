<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class PlanningequipementsQuery extends Query
{
    protected $attributes = [
        'name' => 'planningequipements'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Planningequipement'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'planning_id' => ['type' => Type::int()],
                'equipement_id' => ['type' => Type::int()],
                'quantite' => ['type' => Type::string()],
                'visite_id' => ['type' => Type::int()],
                'date' => ['type' => Type::string(), 'description' => ''],
                'datefin' => ['type' => Type::string(), 'description' => ''],
                'date' => ['type' => Type::string(), 'description' => ''],
                'datefin' => ['type' => Type::string(), 'description' => ''],
                'commercial_id' => ['type' => Type::int()],

                'quantiterestante' => ['type' => Type::string()],

                'commercial_id' => ['type' => Type::int()],

                'est_activer' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryPlanningequipement($args);

        return $query->get()->each(function ($item) use ($args) {
            $item->setAttribute('graphql_args', $args);
        });
    }
}
