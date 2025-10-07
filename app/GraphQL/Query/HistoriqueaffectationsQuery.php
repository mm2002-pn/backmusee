<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class HistoriqueaffectationsQuery extends Query
{
    protected $attributes = [
        'name' => 'historiqueaffectations',
        'description' => ''
    ];

    public function type(): Type
    {
        // result of query with pagination laravel
        return Type::listOf(GraphQL::type('Historiqueaffectation'));
    }

    // arguments to filter query
    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'date' => ['type' => Type::string(), 'description' => ''],
                'antenne_id' => ['type' => Type::int(), 'description' => ''],
                'user_id' => ['type' => Type::int(), 'description' => ''],

                'order'                                     => ['type' => Type::string()],
                'direction'                                 => ['type' => Type::string()],

            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryHistoriqueaffectation($args);
        return $query->get();
    }
}
