<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class MesurePaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'mesurespaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('mesurespaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::int(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => 'Désignation de la mesure'],
            'description' => ['type' => Type::string(), 'description' => 'Description de la mesure'],
            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryMesure($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
