<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class HistogrammebestclientsQuery extends Query
{
    protected $attributes = [
        'name' => 'histogrammebestclients'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Histogrammebestclient'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'intitule' => ['type' => Type::string(), 'description' => ''],
                'ca' => ['type' => Type::float(), 'description' => ''],
                'date' => ['type' => Type::string(), 'description' => ''],
                'datefin' => ['type' => Type::string(), 'description' => ''],
                'est_activer' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryHistogrammebestclient($args);

        return $query->get();
    }
}
