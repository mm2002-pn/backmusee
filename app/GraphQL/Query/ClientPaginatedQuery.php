<?php

namespace App\GraphQL\Query;

use App\Outil;
use App\Candidature;
use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class ClientPaginatedQuery extends Query
{

    protected $attributes = [
        'name' => 'clientspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('clientspaginated');
    }
    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::id()],
                'designation' => ['type' => Type::string(), 'description' => ''],
                'telfixe' => ['type' => Type::string(), 'description' => ''],
                'telmobile' => ['type' => Type::string(), 'description' => ''],
                'region' => ['type' => Type::string(), 'description' => ''],
                'district' => ['type' => Type::string(), 'description' => ''],
                'categorieclient_id' => ['type' => Type::int(), 'description' => ''],
                'typeclient_id' => ['type' => Type::int(), 'description' => ''],

                'user_id' => ['type' => Type::int(), 'description' => ''],

                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }
    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryClient($args);

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->orderBy('id', 'desc')->paginate($count, ['*'], 'page', $page);
    }
}
