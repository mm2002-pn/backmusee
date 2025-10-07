<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ZoneplannifiersQuery extends Query
{
    protected $attributes = [
        'name' => 'zoneplannifiers',
        'description' => '',
    ];
    public function type(): Type
    {
        return Type::listOf(GraphQL::type("Zoneplannifier"));
    }
    public function args(): array
    {
        return
            [
            'id' => ['type' => Type::id()],
            'planning_id' => ['type' => Type::int()],
            'user_id' => ['type' => Type::int()],
            'zone_id' => ['type' => Type::int()],
            'pointdeventes' => ['type' => Type::int()],
            'recouvrement' => ['type' => Type::string()],
            'datedebut' =>  ['type' => Type::string()],
            'datefin' => ['type' => Type::string()],
            'etat' => ['type' => Type::int()],
            'pointvisites' => ['type' => Type::int()],
        ];
    }
    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryZoneplannifier($args);
        return $query->get();
    }
}
