<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class FichecriterePaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'fichecriterespaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('fichecriterespaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'ficheevaluation_id' => ['type' => Type::int(), 'description' => ''],
            'critere_id' => ['type' => Type::int(), 'description' => ''],
            'ponderation' => ['type' => Type::float(), 'description' => ''],
            'ordre' => ['type' => Type::int(), 'description' => ''],
            'created_at' => ['type' => Type::string(), 'description' => ''],
            'updated_at' => ['type' => Type::string(), 'description' => ''],
            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryFichecritere($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
