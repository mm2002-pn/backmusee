<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class CategorietarifaireproduitPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'categorietarifaireproduitspaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('categorietarifaireproduitspaginated');
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


                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQuerycategorietarifaireproduit($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
