<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DaevenementsQuery extends Query
{
    protected $attributes = [
        'name' => 'daevenements',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Daevenement'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'da_id' => ['type' => Type::int(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'date' => ['type' => Type::string(), 'description' => ''],

        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDaevenement($args);
        return $query->get();
    }
}
