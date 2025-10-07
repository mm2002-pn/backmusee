<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class ModepaiementPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'modepaiementspaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('modepaiementspaginated');
    }

    public function args(): array
    {
        return
            [
                'id'=> ['type' => Type::int()],
                'designation' => ['type' => Type::string()],
                'desc' => ['type' => Type::string()],
                'image' => ['type' => Type::string(), 'description' => ''],
                'code' => ['type' => Type::string(), 'description' => ''],
                'imgurl' => ['type' => Type::string(), 'description' => ''],
                'modepaiement_id' => ['type' => Type::int(), 'description' => ''],

                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryModepaiement($args);

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->paginate($count, ['*'], 'page', $page);

    }


}
