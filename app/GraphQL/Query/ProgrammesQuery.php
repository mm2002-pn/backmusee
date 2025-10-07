<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ProgrammesQuery extends Query
{
    protected $attributes = [
        'name' => 'programmes',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Programme'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'equipegestion_id' => ['type' => Type::id(), 'description' => ''],
            'objectif' => ['type' => Type::string(), 'description' => ''],
            'missions' => ['type' => Type::string(), 'description' => ''],
            'date' => ['type' => Type::string(), 'description' => ''],
            'statut' => ['type' => Type::string(), 'description' => ''],

        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryProgramme($args);
        return $query->get();
    }
}
