<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class BlsQuery extends Query
{
    protected $attributes = [
        'name' => 'bls',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Bl'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'commercial_id' => ['type' => Type::int(), 'description' => ''],
                'code' => ['type' => Type::string(), 'description' => ''],
                'issend' => ['type' => Type::int(), 'description' => ''],
                'date' => ['type' => Type::string(), 'description' => ''],
                'datefin' => ['type' => Type::string(), 'description' => ''],
                'datedebut' => ['type' => Type::string(), 'description' => ''],
                'dateenvoie' => ['type' => Type::string(), 'description' => ''],
                // datedebutperiode
                'datedebutperiode' => ['type' => Type::string(), 'description' => ''],

                // datefinperiode
                'datefinperiode' => ['type' => Type::string(), 'description' => ''],
                "antenne_id" => ['type' => Type::int()],
                'est_activer' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryBl($root, $args);
        return $query->get();
    }
}
