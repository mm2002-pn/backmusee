<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class EncaissementsQuery extends Query
{
    protected $attributes = [
        'name' => 'encaissements'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Encaissement'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                
                'numfacture' => ['type' => Type::string(), 'description' => ''],
                'montantaregle' => ['type' => Type::string(), 'description' => ''],
                'montantrecouvrement' => ['type' => Type::string(), 'description' => ''],
                'montantreglement' => ['type' => Type::string(), 'description' => ''],
                'typeencaissement_id' => ['type' => Type::int(), 'description' => ''],
                //montantrecuperer
                'montantrecuperer' => ['type' => Type::string(), 'description' => ''],
                'isreglement' => ['type' => Type::int(), 'description' => ''],

                'est_activer' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],



            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryEncaissement($args);

        return $query->get();
    }
}
