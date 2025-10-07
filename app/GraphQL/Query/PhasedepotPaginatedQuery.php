<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class PhasedepotPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'phasedepotspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('phasedepotspaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'datedeb' => ['type' => Type::string(), 'description' => ''],
            'datefin' => ['type' => Type::string(), 'description' => ''],
            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'etat' => ['type' => Type::int(), 'description' => ''],
            'campagne_id' => ['type' => Type::int(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'description' => ['type' => Type::string(), 'description' => ''],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryPhasedepot($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
