<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DetailcommandesQuery extends Query
{
    protected $attributes = [
        'name' => 'detailcommandes',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Detailcommande'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'article_id' => ['type' => Type::int(), 'description' => ''],
            'quantite' => ['type' => Type::int(), 'description' => ''],
            'prix' => ['type' => Type::int(), 'description' => ''],
            'avg' => ['type' => Type::int(), 'description' => ''],
            'commande_id' => ['type' => Type::int(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDetailcommande($args);
        return $query->get();
    }
}
