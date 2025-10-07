<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DetailmaterielsQuery extends Query
{
    protected $attributes = [
        'name' => 'detailmateriels'
    ];

    public function type(): Type
    {
       return Type::listOf(GraphQL::type('Detailmateriel'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'equipement_id' => ['type' => Type::int(), 'description' => ''],
                'type' => ['type' => Type::int(), 'description' => ''],
                'quantite' => ['type' => Type::int(), 'description' => ''],
                'visite_id' => ['type' => Type::int(), 'description' => ''],
                'demande_id' => ['type' => Type::int(), 'description' => ''],
                'est_activer' => ['type' => Type::int(), 'description' => ''],


                'est_activer' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDetailmateriel($args);

        return $query->get();
    }
}
