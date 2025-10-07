<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class ProduitPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'produitspaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('produitspaginated');
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
                // prixconseillerdetailland
                'prixconseillerdetaillant' => ['type' => Type::float(), 'description' => ''],
                // prixconseillerclient
                'prixconseillerclient' => ['type' => Type::float(), 'description' => ''],

                'colisage' => ['type' => Type::int(), 'description' => ''],


                'categorie_id' => ['type' => Type::int(), 'description' => ''],
                'image' => ['type' => Type::string(), 'description' => ''],
                // imgurl
                'imgurl' => ['type' => Type::string(), 'description' => ''],

                // 
                'unite_id' => ['type' => Type::int(), 'description' => ''],


                // isdisplay

                'isdisplay' => ['type' => Type::int()],

                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryProduit($args);

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->paginate($count, ['*'], 'page', $page);
    }
}
