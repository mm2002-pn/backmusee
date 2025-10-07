<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DaofournisseursQuery extends Query
{
    protected $attributes = [
        'name' => 'daofournisseurs',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Daofournisseur'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'fournisseur_id' => ['type' => Type::int(), 'description' => ''],
            'da_id' => ['type' => Type::int(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDaofournisseur($args);
        return $query->get();
    }
}
