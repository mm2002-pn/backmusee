<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class UserPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'userspaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('userspaginated');
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'name' => ['type' => Type::string()],
                'role_id' => ['type' => Type::int()],
                'telephone' => ['type' => Type::string(), 'description' => ''],
                'email' => ['type' => Type::string()],
                'login' => ['type' => Type::string(), 'description' => ''],
                'ischantenne' => ['type' => Type::int(), 'description' => ''],

                'code' => ['type' => Type::string(), 'description' => ''],
                'compteclient' => ['type' => Type::string(), 'description' => ''],

                'profilable_id' => ['type' => Type::int(), 'description' => ''],
                'profilable_type' => ['type' => Type::string(), 'description' => ''],

                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order' => ['type' => Type::string()],
                'direction' => ['type' => Type::string()],
            ];
    }


    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryUser($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
