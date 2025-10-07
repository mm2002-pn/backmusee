<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class RemisedureedeviesQuery extends Query
{
    protected $attributes = [
        'name' => 'remisedureedevies',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Remisedureedevie'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'typeduree' => ['type' => Type::int(), 'description' => ''],
            'moinsnim' => ['type' => Type::int(), 'description' => ''],
            'moismax' => ['type' => Type::int(), 'description' => ''],
            'remisepourcentage' => ['type' => Type::int(), 'description' => ''],
            'remisevaleur' => ['type' => Type::float(), 'description' => ''],
            'article_id' => ['type' => Type::int(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryRemisedureedevie($args);
        return $query->get();
    }
}
