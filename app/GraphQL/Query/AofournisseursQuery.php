<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AofournisseursQuery extends Query
{
    protected $attributes = [
        'name' => 'aofournisseurs',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Aofournisseur'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'ao_id' => ['type' => Type::id(), 'description' => ''],
            'fournisseur_id' => ['type' => Type::id(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryAofournisseur($args);
        return $query->get();
    }
}
