<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class ArticlePaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'articlespaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('articlespaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::int(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'prix' => ['type' => Type::float(), 'description' => ''],
            'quantite' => ['type' => Type::int(), 'description' => ''],
            'description' => ['type' => Type::string(), 'description' => ''],
            'categorie_id' => ['type' => Type::int(), 'description' => ''],
            'unite_id' => ['type' => Type::int(), 'description' => ''],
            'estactive' => ['type' => Type::int(), 'description' => ''],
            'COURTEDUREE_0' => ['type' => Type::int(), 'description' => ''],
            'COURTEDUREE_0_id' => ['type' => Type::int(), 'description' => ''],
            'TCLCOD_0_id' => ['type' => Type::int(), 'description' => ''],
            'TCLCOD_0' => ['type' => Type::int(), 'description' => ''],


            'image' => ['type' => Type::string(), 'description' => ''],
            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryArticle($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
