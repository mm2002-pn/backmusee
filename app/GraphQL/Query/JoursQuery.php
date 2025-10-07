<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class JoursQuery extends Query
{
    protected $attributes = [
        'name' => 'jours',
        'description' => '',
    ];
    public function type(): Type
    {
        return Type::listOf(GraphQL::type("Jour"));
    }
    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'name' => ['type' => Type::string()],
                'jour' => ['type' => Type::int()],
        ];
    }
    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryJour($args);
        return $query->get();
    }
}
