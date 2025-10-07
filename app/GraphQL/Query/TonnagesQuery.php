<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TonnagesQuery extends Query
{
    protected $attributes = [
        'name' => 'tonnages',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Tonnage'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'min' => ['type' => Type::float(), 'description' => ''],
            'max' => ['type' => Type::float(), 'description' => ''],
            'tonnage' => ['type' => Type::float(), 'description' => ''],
            'unite_id' => ['type' => Type::int(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryTonnage($args);
        return $query->get();
    }
}
