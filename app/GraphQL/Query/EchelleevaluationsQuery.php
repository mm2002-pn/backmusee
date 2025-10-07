<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class EchelleevaluationsQuery extends Query
{
    protected $attributes = [
        'name' => 'echelleevaluations',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Echelleevaluation'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'critere_id' => ['type' => Type::int(), 'description' => ''],
            'min' => ['type' => Type::float(), 'description' => ''],
            'max' => ['type' => Type::float(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'points' => ['type' => Type::float(), 'description' => ''],
            'ordre' => ['type' => Type::int(), 'description' => ''],
            'created_at' => ['type' => Type::string(), 'description' => ''],
            'updated_at' => ['type' => Type::string(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryEchelleevaluation($args);
        return $query->get();
    }
}
