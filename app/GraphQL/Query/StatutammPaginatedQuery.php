<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class StatutammPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'statutammspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('statutammspaginated');
    }

    public function args(): array
    {
        return [
            'article_id' => ['type' => Type::id(), 'description' => 'article_id'],

            'designationsalama' => ['type' => Type::string(), 'description' => ''],
            'nomcommercial' => ['type' => Type::string(), 'description' => ''],
            'nomfournisseur' => ['type' => Type::string(), 'description' => ''],
            'fournisseur_id' => ['type' => Type::int(), 'description' => ''],
            'codeproduit' => ['type' => Type::string(), 'description' => ''],

            'laboratoiretitulaire' => ['type' => Type::string(), 'description' => ''],
            'laboratoirefabriquant' => ['type' => Type::string(), 'description' => ''],
            'numeroamm' => ['type' => Type::string(), 'description' => ''],
            'datedelivranceamm' => ['type' => Type::string(), 'description' => ''],
            'dateexpirationamm' => ['type' => Type::string(), 'description' => ''],
            'statutenregistrement' => ['type' => Type::int(), 'description' => ''],

            'laboratoiretitulaire_id' => ['type' => Type::int(), 'description' => ''],
            'laboratoirefabriquant_id' => ['type' => Type::int(), 'description' => ''],


            'dateexpiration' => ['type' => Type::string(), 'description' => ''],
            'datedelivrance' => ['type' => Type::string(), 'description' => ''],




            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryStatutamm($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
