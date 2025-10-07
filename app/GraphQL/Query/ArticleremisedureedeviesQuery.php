<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ArticleremisedureedeviesQuery extends Query
{
    protected $attributes = [
        'name' => 'articleremisedureedevies',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Articleremisedureedevie'));
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

        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryArticleremisedureedevie($args);
        return $query->get();
    }
}
