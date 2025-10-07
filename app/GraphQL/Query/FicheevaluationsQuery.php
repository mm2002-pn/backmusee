<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class FicheevaluationsQuery extends Query
{
    protected $attributes = [
        'name' => 'ficheevaluations',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Ficheevaluation'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'annee' => ['type' => Type::int(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'isactive' => ['type' => Type::int(), 'description' => ''],
            'TSSCOD_0_0' => ['type' => Type::string(), 'description' => ''],
            'modelfiche'  => ['type' => Type::int(), 'description' => ''],


        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryFicheevaluation($args);
        return $query->get();
    }
}
