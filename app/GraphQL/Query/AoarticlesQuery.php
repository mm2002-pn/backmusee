<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AoarticlesQuery extends Query
{
    protected $attributes = [
        'name' => 'aoarticles',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Aoarticle'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'margevaleur' => ['type' => Type::string(), 'description' => ''],
            'margepourcentage' => ['type' => Type::string(), 'description' => ''],
            'ao_id' => ['type' => Type::id(), 'description' => ''],
            'quantite' => ['type' => Type::float(), 'description' => ''],
            'targetprice' => ['type' => Type::float(), 'description' => ''],
            'article_id' => ['type' => Type::id(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryAoarticle($args);
        return $query->get();
    }
}
