<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UnitesQuery extends Query
{
    protected $attributes = [
        'name' => 'unites'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Unite'));
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::int()],
            'designation' => ['type' => Type::string()],
            'description' => ['type' => Type::string(), 'description' => ''],
            'code' => ['type' => Type::string(), 'description' => ''],
            
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryUnite($args);
        return $query->get();
    }
}
