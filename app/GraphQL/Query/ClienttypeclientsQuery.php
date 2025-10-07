<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ClienttypeclientsQuery extends Query
{
    protected $attributes = [
        'name' => 'clienttypeclients',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Clienttypeclient'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'client_id' => ['type' => Type::int(), 'description' => ''],
            'typeclient_id' => ['type' => Type::int(), 'description' => ''],

        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryClienttypeclient($args);
        return $query->get();
    }
}
