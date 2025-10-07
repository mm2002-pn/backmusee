<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class SoumissionsQuery extends Query
{
    protected $attributes = [
        'name' => 'soumissions',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Soumission'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'date' => ['type' => Type::string(), 'description' => ''],
            'score' => ['type' => Type::float(), 'description' => ''],
            'statut' => ['type' => Type::int(), 'description' => ''],
            'urlbc' => ['type' => Type::string(), 'description' => ''],
            'etatcontractel' => ['type' => Type::id(), 'description' => ''],

            'urlcontrat' => ['type' => Type::string(), 'description' => ''],
            'isbc' => ['type' => Type::int(), 'description' => ''],
            'iscontrat' => ['type' => Type::int(), 'description' => ''],
            'ao_id' => ['type' => Type::id(), 'description' => ''],
            'fournisseur_id' => ['type' => Type::id(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQuerySoumission($args);
        return $query->get();
    }
}
