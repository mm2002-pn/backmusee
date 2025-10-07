<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class DetaillivraisonPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'detaillivraisonspaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('detaillivraisonspaginated');
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

                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDetaillivraison($args);

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->paginate($count, ['*'], 'page', $page);
    }
}
