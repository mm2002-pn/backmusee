<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TypemarchedetailsQuery extends Query
{
    protected $attributes = [
        'name' => 'typemarchedetails',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Typemarchedetail'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'position' => ['type' => Type::string(), 'description' => ''],
            'description' => ['type' => Type::string(), 'description' => ''],
            'typemarche_id' => ['type' => Type::int(), 'description' => ''],
            'parcourmarche_id' => ['type' => Type::int(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryTypemarchedetail($args);
        return $query->get();
    }
}
