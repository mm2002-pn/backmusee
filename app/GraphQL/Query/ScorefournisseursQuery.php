<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ScorefournisseursQuery extends Query
{
    protected $attributes = [
        'name' => 'scorefournisseurs',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Scorefournisseur'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'score' => ['type' => Type::int(), 'description' => ''],
            'fournisseur_id' => ['type' => Type::id(), 'description' => ''],
            'annee' => ['type' => Type::string(), 'description' => ''],


        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryScorefournisseur($args);
        return $query->get();
    }
}
