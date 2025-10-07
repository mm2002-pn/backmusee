<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ZonepointdeventesQuery extends Query
{
    protected $attributes = [
        'name' => 'zonepointdeventes'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Zonepointdevente'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'zone_id' => ['type' => Type::int()],
                'est_activer' => ['type' => Type::int()],
                'order' => ['type' => Type::string()],
                'direction' => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryZonepointdevente($args);

        return $query->get();
    }
}
