<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class AoarticlePaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'aoarticlespaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('aoarticlespaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'margevaleur' => ['type' => Type::string(), 'description' => ''],
            'quantite' => ['type' => Type::float(), 'description' => ''],
            'targetprice' => ['type' => Type::float(), 'description' => ''],
            'margepourcentage' => ['type' => Type::string(), 'description' => ''],
            'ao_id' => ['type' => Type::id(), 'description' => ''],
            'article_id' => ['type' => Type::id(), 'description' => ''],
            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryAoarticle($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
