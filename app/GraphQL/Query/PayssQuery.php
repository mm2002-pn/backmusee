<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class PayssQuery extends Query
{
    protected $attributes = [
        'name' => 'pays',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Pays'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::int(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryPays($args);
        return $query->get();
    }
}
