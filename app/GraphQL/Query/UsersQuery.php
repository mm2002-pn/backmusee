<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'users',
        'description' => ''
    ];

    public function type(): Type
    {
        // result of query with pagination laravel
        return Type::listOf(GraphQL::type('User'));
    }

    // arguments to filter query
    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'name' => ['type' => Type::string()],
                'login' => ['type' => Type::string(), 'description' => ''],
                'email' => ['type' => Type::string()],
                //telephone
                'telephone' => ['type' => Type::string(), 'description' => ''],
                // ischantenne
                'ischantenne' => ['type' => Type::int(), 'description' => ''],
                'code' => ['type' => Type::string(), 'description' => ''],
                'compteclient' => ['type' => Type::string(), 'description' => ''],
                'profilable_id' => ['type' => Type::int(), 'description' => ''],
                'profilable_type' => ['type' => Type::string(), 'description' => ''],

                'role_id' => ['type' => Type::int()],
                'order'                                     => ['type' => Type::string()],
                'direction'                                 => ['type' => Type::string()],

            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryUser($args);
        return $query->get();
    }
}
