<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class FournisseurattachementsQuery extends Query
{
    protected $attributes = [
        'name' => 'fournisseurattachements',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Fournisseurattachement'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'fournisseur_id' => ['type' => Type::id(), 'description' => ''],
            'dossierfournisseur_id' => ['type' => Type::id(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryFournisseurattachement($args);
        return $query->get();
    }
}
