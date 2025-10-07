<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ProduitsQuery extends Query
{
    protected $attributes = [
        'name' => 'produits'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Produit'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'designation' => ['type' => Type::string()],
                'description' => ['type' => Type::string()],
                'code' => ['type' => Type::string(), 'description' => ''],
                'prix' => ['type' => Type::string(), 'description' => ''],
                'prixconseille' => ['type' => Type::string(), 'description' => ''],

                'categorie_id' => ['type' => Type::int(), 'description' => ''],

                'isdisplay' => ['type' => Type::int()],
                'colisage' => ['type' => Type::int(), 'description' => ''],

                // prixconseillerdetailland
                'prixconseillerdetaillant' => ['type' => Type::float(), 'description' => ''],
                // prixconseillerclient
                'prixconseillerclient' => ['type' => Type::float(), 'description' => ''],

                'image' => ['type' => Type::string(), 'description' => ''],
                'unite_id' => ['type' => Type::int(), 'description' => ''],

                // imgurl
                'imgurl' => ['type' => Type::string(), 'description' => ''],
                'est_activer' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryProduit($args);

        return $query->get();
    }
}
