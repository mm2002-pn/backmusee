<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class ProspectPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'prospectspaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('prospectspaginated');
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'designation' => ['type' => Type::string(), 'description' => ''],
                'adresse' => ['type' => Type::string(), 'description' => ''],
                'intitule' => ['type' => Type::string(), 'description' => ''],
                'numbcpttier' => ['type' => Type::string(), 'description' => ''],
                'zone_id' => ['type' => Type::int(), 'description' => ''],

                'telephone' => ['type' => Type::string(), 'description' => ''],
                'images' => ['type' => Type::string(), 'description' => ''],
                'email' => ['type' => Type::string(), 'description' => ''],
                'gps' => ['type' => Type::string(), 'description' => ''],
                'client_id' => ['type' => Type::int(), 'description' => ''],
                "img_local" => ['type' => Type::string(), 'description' => ''],
                'estdivers' => ['type' => Type::int(), 'description' => ''],

                // ventedirect
                'ventedirect' => ['type' => Type::string(), 'description' => ''],

                // etat

                'etat' => ['type' => Type::string(), 'description' => ''],

                'latitude' => ['type' => Type::string(), 'description' => ''],
                'longitude' => ['type' => Type::string(), 'description' => ''],
                'zone_id' => ['type' => Type::int(), 'description' => ''],
                'est_activer' => ['type' => Type::int()],

                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryProspect($args);

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->paginate($count, ['*'], 'page', $page);
    }
}
