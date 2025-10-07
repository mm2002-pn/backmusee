<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DetailtypemarchedetailsQuery extends Query
{
    protected $attributes = [
        'name' => 'detailtypemarchedetails',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Detailtypemarchedetail'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'role_id' => ['type' => Type::id(), 'description' => ''],
            'typemarchedetail_id' => ['type' => Type::id(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDetailtypemarchedetail($args);
        return $query->get();
    }
}
