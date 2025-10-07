<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class FabricantsQuery extends Query
{
    protected $attributes = [
        'name' => 'fabricants',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Fabricant'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::int(), 'description' => ''],
            'email' => ['type' => Type::string(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'code' => ['type' => Type::string(), 'description' => ''],
            'adresse' => ['type' => Type::string(), 'description' => ''],
            'telephone' => ['type' => Type::string(), 'description' => ''],
            'pay_id' => ['type' => Type::int(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryFabricant($args);
        return $query->get();
    }
}
