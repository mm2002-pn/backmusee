<?php

namespace App\GraphQL\Query;

use App\Outil;
use App\Candidature;
use App\Models\QueryModel;
use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ClientsQuery extends Query
{
    protected $attributes = [
        'name' => 'clients',
        'description' => ''
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Client'));
    }

    public function args(): array
    {
        return  [
            'id' => ['type' => Type::id()],

            'designation' => ['type' => Type::string(), 'description' => ''],
            'telfixe' => ['type' => Type::string(), 'description' => ''],
            'telmobile' => ['type' => Type::string(), 'description' => ''],
            'region' => ['type' => Type::string(), 'description' => ''],
            'district' => ['type' => Type::string(), 'description' => ''],
            'categorieclient_id' => ['type' => Type::int(), 'description' => ''],
            'user_id' => ['type' => Type::int(), 'description' => ''],
            'typeclient_id' => ['type' => Type::int(), 'description' => ''],


            'order'          => ['type' => Type::string()],
            'direction'      => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryClient($args);
        return $query->get();
    }
}
