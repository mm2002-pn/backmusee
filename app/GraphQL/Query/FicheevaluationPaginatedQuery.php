<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class FicheevaluationPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'ficheevaluationspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('ficheevaluationspaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'annee' => ['type' => Type::int(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'isactive' => ['type' => Type::int(), 'description' => ''],

            'TSSCOD_0_0' => ['type' => Type::string(), 'description' => ''],
            'modelfiche'  => ['type' => Type::int(), 'description' => ''],


            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryFicheevaluation($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
