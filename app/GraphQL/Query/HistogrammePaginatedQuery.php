<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class HistogrammePaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'histogrammespaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('histogrammespaginated');
    }

    public function args(): array
    {
        return
            [
                'produit_id' => ['type' => Type::int(), 'description' => 'Product ID'],
                'quantite_totale' => ['type' => Type::float(), 'description' => 'Total quantity sold'],
                'chiffre_affaires' => ['type' => Type::float(), 'description' => 'Total revenue (Chiffre d\'Affaires)'],
                'date' => ['type' => Type::string(), 'description' => ''],
                'datefin' => ['type' => Type::string(), 'description' => ''],
                'commercial_id' => ['type' => Type::int(), 'description' => ''],


                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        // Récupérer la requête
        $query = QueryModel::getQueryHistogramme($args);
        // dd($query,"query");

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->paginate($count, ['*'], 'page', $page);
    }
}
