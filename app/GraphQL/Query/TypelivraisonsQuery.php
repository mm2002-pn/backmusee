<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TypelivraisonsQuery extends Query
{
    protected $attributes = [
        'name' => 'typelivraisons',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Typelivraison'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'description' => ['type' => Type::string(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryTypelivraison($args);
        return $query->get();
    }
}
