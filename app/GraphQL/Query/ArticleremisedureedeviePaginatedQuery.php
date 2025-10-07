<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class ArticleremisedureedeviePaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'articleremisedureedeviespaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('articleremisedureedeviespaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'article_id' => ['type' => Type::int(), 'description' => ''],
            'remisedureedevie_id' => ['type' => Type::int(), 'description' => ''],


            'date' => ['type' => Type::string(), 'description' => ''],
            'remisevaleur' => ['type' => Type::float(), 'description' => ''],
            'remisepourcentage' => ['type' => Type::float(), 'description' => ''],

            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryArticleremisedureedevie($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
