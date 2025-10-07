<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class BlPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'blspaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('blspaginated');
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'commercial_id' => ['type' => Type::int(), 'description' => ''],


                "antenne_id" => ['type' => Type::int()],

                // code
                'code' => ['type' => Type::string(), 'description' => ''],
                'issend' => ['type' => Type::int(), 'description' => ''],

                // datedebutperiode
                'datedebutperiode' => ['type' => Type::string(), 'description' => ''],

                // datefinperiode
                'datefinperiode' => ['type' => Type::string(), 'description' => ''],
                
                'date' => ['type' => Type::string(), 'description' => ''],
                'datedebut' => ['type' => Type::string(), 'description' => ''],
                'dateenvoie' => ['type' => Type::string(), 'description' => ''],
                'datefin' => ['type' => Type::string(), 'description' => ''],

                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryBl($root, $args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->paginate($count, ['*'], 'page', $page);
    }
}
