<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class StatutammsQuery extends Query
{
    protected $attributes = [
        'name' => 'statutamms',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Statutamm'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],

            'article_id' => ['type' => Type::id(), 'description' => 'article_id'],

            'designationsalama' => ['type' => Type::string(), 'description' => ''],
            'nomcommercial' => ['type' => Type::string(), 'description' => ''],
            'nomfournisseur' => ['type' => Type::string(), 'description' => ''],

            'laboratoiretitulaire' => ['type' => Type::string(), 'description' => ''],
            'laboratoirefabriquant' => ['type' => Type::string(), 'description' => ''],
            'numeroamm' => ['type' => Type::string(), 'description' => ''],
            'codeproduit' => ['type' => Type::string(), 'description' => ''],

            'fournisseur_id' => ['type' => Type::int(), 'description' => ''],
            'statutenregistrement' => ['type' => Type::int(), 'description' => ''],
            'laboratoiretitulaire_id' => ['type' => Type::int(), 'description' => ''],
            'laboratoirefabriquant_id' => ['type' => Type::int(), 'description' => ''],

            'dateexpiration' => ['type' => Type::string(), 'description' => ''],
            'datedelivrance' => ['type' => Type::string(), 'description' => ''],





            'datedelivranceamm' => ['type' => Type::string(), 'description' => ''],
            'dateexpirationamm' => ['type' => Type::string(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryStatutamm($args);
        return $query->get();
    }
}
