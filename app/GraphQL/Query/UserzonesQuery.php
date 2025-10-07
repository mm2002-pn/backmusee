<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UserzonesQuery extends Query
{
    protected $attributes = [
        'name' => 'userzones',
        'description' => ''
    ];

    public function type(): Type
    {
        // result of query with pagination laravel
        return Type::listOf(GraphQL::type('Userzone'));
    }

    // arguments to filter query
    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'zone_id' => ['type' => Type::int(), 'description' => ''],

                'user_id' => ['type' => Type::int(), 'description' => ''],
                'date' => ['type' => Type::string(), 'description' => ''],

                'order'                                     => ['type' => Type::string()],
                'direction'                                 => ['type' => Type::string()],

            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryUserzone($args);
        return $query->get();
    }
}
