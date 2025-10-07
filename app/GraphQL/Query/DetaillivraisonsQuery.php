<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DetaillivraisonsQuery extends Query
{
    protected $attributes = [
        'name' => 'detaillivraisons'
    ];

    public function type(): Type
    {
       return Type::listOf(GraphQL::type('Detaillivraison'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'visite_id' => ['type' => Type::int(), 'description' => ''],
                'produit_id' => ['type' => Type::int(), 'description' => ''],
                'quantite' => ['type' => Type::string(), 'description' => ''],
                'unite_id' => ['type' => Type::int(), 'description' => ''],
                'prix' => ['type' => Type::int(), 'description' => ''],

                'est_activer' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDetaillivraison($args);

        return $query->get();
    }

  
}
