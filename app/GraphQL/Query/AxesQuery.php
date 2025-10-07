<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AxesQuery extends Query
{
    protected $attributes = [
        'name' => 'axes'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Axe'));
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::int()],
            'designation' => ['type' => Type::string()],
            'description' => ['type' => Type::string(), 'description' => ''],
            'province_id' => ['type' => Type::int(), 'description' => ''],
            
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryAxe($args);
        return $query->get();
    }
}
