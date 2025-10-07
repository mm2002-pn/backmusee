<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class EncaissementPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'encaissementspaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('encaissementspaginated');
    }

    public function args(): array
    {
        return
            [
                'id'=> ['type' => Type::int()],
                'numfacture' => ['type' => Type::string(), 'description' => ''],
                'montantaregle' => ['type' => Type::string(), 'description' => ''],
                'montantrecouvrement' => ['type' => Type::string(), 'description' => ''],
                'montantreglement' => ['type' => Type::string(), 'description' => ''],
                'montantrecuperer' => ['type' => Type::string(), 'description' => ''],
                'typeencaissement_id' => ['type' => Type::int(), 'description' => ''],
                'isreglement' => ['type' => Type::int(), 'description' => ''],


                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryEncaissement($args);

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->paginate($count, ['*'], 'page', $page);

    }


}
