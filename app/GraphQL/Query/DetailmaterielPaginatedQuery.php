<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class DetailmaterielPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'detailmaterielspaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('detailmaterielspaginated');
    }

    public function args(): array
    {
        return
            [
                'id'=> ['type' => Type::int()],

                'equipement_id' => ['type' => Type::int(), 'description' => ''],
                'type' => ['type' => Type::int(), 'description' => ''],
                'quantite' => ['type' => Type::int(), 'description' => ''],
                'visite_id' => ['type' => Type::int(), 'description' => ''],
                'demande_id' => ['type' => Type::int(), 'description' => ''],
                'est_activer' => ['type' => Type::int(), 'description' => ''],



                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDetailmateriel($args);

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->paginate($count, ['*'], 'page', $page);

    }


}
