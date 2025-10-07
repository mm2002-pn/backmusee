<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class VoituresQuery extends Query
{
    protected $attributes = [
        'name' => 'voitures'
    ];

    public function type(): Type
    {
       return Type::listOf(GraphQL::type('Voiture'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'matricule' => ['type' => Type::string()],
                'marque' => ['type' => Type::string()],
                'code' => ['type' => Type::string(), 'description' => ''],

                'est_activer' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryVoiture($args);

        return $query->get();
    }
}
