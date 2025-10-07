<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class VisitePaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'visitespaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('visitespaginated');
    }

    public function args(): array
    {
        return
            [
                'id'=> ['type' => Type::int()],
                'commercial_id' => ['type' => Type::int(), 'description' => ''],
                'pointdevente_id' => ['type' => Type::int(), 'description' => ''],
                'date' => ['type' => Type::string(), 'description' => ''],
                'datefin' => ['type' => Type::string(), 'description' => ''],
                'voiture_id'    => ['type' => Type::int(), 'description' => ''],

                'commentaire' => ['type' => Type::string(), 'description' => ''],
                'planning_id' => ['type' => Type::int(), 'description' => ''],
                'etatquantite' => ['type' => Type::int(), 'description' => ''],
                //etatmateriel
                'etatmateriel' => ['type' => Type::int(), 'description' => ''],
                //etatencaissement
                'etatrecouvrement' => ['type' => Type::int(), 'description' => ''],
                'etatreglement' => ['type' => Type::int(), 'description' => ''],
                'zone_id' => ['type' => Type::int(), 'description' => ''],
                "antenne_id" => ['type' => Type::int()],

                // montantencaissement
                'montantencaissement' => ['type' => Type::float(), 'description' => ''],
                
                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryVisite($root,$args);

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->paginate($count, ['*'], 'page', $page);

    }


}
