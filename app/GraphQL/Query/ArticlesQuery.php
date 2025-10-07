<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ArticlesQuery extends Query
{
    protected $attributes = [
        'name' => 'articles',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Article'));
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
            'moismin' => ['type' => Type::int(), 'description' => ''],
            'moismax' => ['type' => Type::int(), 'description' => ''],
            'COURTEDUREE_0' => ['type' => Type::int(), 'description' => ''],
            'COURTEDUREE_0_id' => ['type' => Type::int(), 'description' => ''],
            'TCLCOD_0_id' => ['type' => Type::int(), 'description' => ''],
            'TCLCOD_0' => ['type' => Type::int(), 'description' => ''],


            'code' => ['type' => Type::string(), 'description' => ''],
            'image' => ['type' => Type::string(), 'description' => ''],
            'estactive' => ['type' => Type::int(), 'description' => ''],

        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryArticle($args);
        $articles = $query->get();

        if (isset($args['id']) && isset($args['moismin']) && isset($args['moismax'])) {
            foreach ($articles as $article) {
                $article->moismin = $args['moismin'];
                $article->moismax = $args['moismax'];
            }
        }

        return $articles;
    }
}
