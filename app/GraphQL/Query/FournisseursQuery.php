<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class FournisseursQuery extends Query
{
    protected $attributes = [
        'name' => 'fournisseurs',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Fournisseur'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::int(), 'description' => ''],
            'email' => ['type' => Type::string(), 'description' => ''],
            'score' => ['type' => Type::float(), 'description' => ''],

            'nom' => ['type' => Type::string(), 'description' => ''],
            'adresse' => ['type' => Type::string(), 'description' => ''],
            'telephone' => ['type' => Type::string(), 'description' => ''],
            'categoriefournisseur' => ['type' => Type::string(), 'description' => ''],
            'typefournisseur' => ['type' => Type::string(), 'description' => ''],
            'typefournisseur_id' => ['type' => Type::int(), 'description' => ''],
            'TSSCOD_0_0_id' => ['type' => Type::int(), 'description' => ''],
            'TSSCOD_0_0' => ['type' => Type::int(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryFournisseur($args);
        return $query->get();
    }
}
