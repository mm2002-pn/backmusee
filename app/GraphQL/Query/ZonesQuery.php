<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ZonesQuery extends Query
{
    protected $attributes = [
        'name' => 'zones'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Zone'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'pointdevente_id' => ['type' => Type::int()],
                'designation' => ['type' => Type::string()],
                'descriptions' => ['type' => Type::string()],
                'antenne_id' => ['type' => Type::int(), 'description' => ''],
                'parent_id' => ['type' => Type::int(), 'description' => ''],

                'est_activer' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryZone($args);

        return $query->get();
    }
}
