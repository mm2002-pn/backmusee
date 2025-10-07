<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TypevehiculesQuery extends Query
{
    protected $attributes = [
        'name' => 'typevehicules',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Typevehicule'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'description' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryTypevehicule($args);
        return $query->get();
    }
}
