<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class ZonePaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'zonespaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('zonespaginated');
    }

    public function args(): array
    {
        return
            [
                'id'=> ['type' => Type::int()],
                'descriptions' => ['type' => Type::string()],
                'designation' => ['type' => Type::string()],
                'est_activer' => ['type' => Type::int()],
                'antenne_id' => ['type' => Type::int(), 'description' => ''],
                'parent_id' => ['type' => Type::int(), 'description' => ''],


                'pointdevente_id' => ['type' => Type::int()],
                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryZone($args);

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->paginate($count, ['*'], 'page', $page);

    }


}
