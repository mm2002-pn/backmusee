<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CategorietarifaireproduitsQuery extends Query
{

    protected $attributes = [
        'name' => 'produitpromotions'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Categorietarifaireproduit'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'produit_id' => ['type' => Type::int(), 'description' => ''],

                'categorietarifaire_id' => ['type' => Type::int(), 'description' => ''],
                'unite_id' => ['type' => Type::int(), 'description' => ''],

                // prix
                'prix' => ['type' => Type::string(), 'description' => ''],
                // remise_achat en float
                'remise_achat' => ['type' => Type::float(), 'description' => ''],
                'remise' => ['type' => Type::float(), 'description' => ''],


                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQuerycategorietarifaireproduit($args);
        return $query->get();
    }
}
