<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ProvincesQuery extends Query
{
    protected $attributes = [
        'name' => 'provinces'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Province'));
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::int()],
            'province' => ['type' => Type::string()],
            'distance' => ['type' => Type::int(), 'description' => ''],
            'code' => ['type' => Type::string(), 'description' => ''],
            
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryProvince($args);
        return $query->get();
    }
}
