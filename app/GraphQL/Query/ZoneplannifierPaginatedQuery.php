<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Arr;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ZoneplannifierPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'zoneplannifierspaginated',
        'description' => 'les planningzones par page',
    ];

    public function type(): Type
    {
        return GraphQL::type("zoneplannifierspaginated");
    }
    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::id()],
                'planning_id' => ['type' => Type::int()],
                'pointdeventes' => ['type' => Type::int()],
                'recouvrement' => ['type' => Type::string()],
                'etat' => ['type' => Type::int()],
                'pointvisites' => ['type' => Type::int()],

                
        ];
    }
    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryZoneplannifier($args);
        $count = Arr::get($args, 'count', 30);
        $page = Arr::get($args, 'page', 1);
        return $query->orderBy('id', 'desc')->paginate($count, ['*'], 'page', $page);

    }
}
