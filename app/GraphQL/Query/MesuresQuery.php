<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class MesuresQuery extends Query
{
    protected $attributes = [
        'name' => 'mesures',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Mesure'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::int(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => 'Désignation de la mesure'],
            'description' => ['type' => Type::string(), 'description' => 'Description de la mesure'],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryMesure($args);
        return $query->get();
    }
}
