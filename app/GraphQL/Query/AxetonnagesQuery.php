<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AxetonnagesQuery extends Query
{
    protected $attributes = [
        'name' => 'axetonnages',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Axetonnage'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'axe_id' => ['type' => Type::int(), 'description' => ''],
            'tonnage_id' => ['type' => Type::int(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryAxetonnage($args);
        return $query->get();
    }
}
