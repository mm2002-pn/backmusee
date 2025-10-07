<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class BailleurprogrammesQuery extends Query
{
    protected $attributes = [
        'name' => 'bailleurprogrammes',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Bailleurprogramme'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'bailleur_id' => ['type' => Type::id(), 'description' => ''],
            'programme_id' => ['type' => Type::id(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryBailleurprogramme($args);
        return $query->get();
    }
}
