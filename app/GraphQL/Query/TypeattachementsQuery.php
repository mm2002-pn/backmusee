<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TypeattachementsQuery extends Query
{
    protected $attributes = [
        'name' => 'typeattachements',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Typeattachement'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryTypeattachement($args);
        return $query->get();
    }
}
