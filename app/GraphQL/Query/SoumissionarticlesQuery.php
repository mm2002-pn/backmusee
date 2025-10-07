<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class SoumissionarticlesQuery extends Query
{
    protected $attributes = [
        'name' => 'soumissionarticles',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Soumissionarticle'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],

            'article_id' => ['type' => Type::id(), 'description' => 'article_id'],
            'soumission_id' => ['type' => Type::id(), 'description' => 'soumission_id'],
            'typecondition_id' => ['type' => Type::id(), 'description' => 'typecondition_id'],
            'fabricant_id' => ['type' => Type::id(), 'description' => 'fabricant_id'],

            'pays_id' => ['type' => Type::id(), 'description' => 'pays_id'],


            'prixunitairepropose' => ['type' => Type::float(), 'description' => 'prixunitairepropose'],
            'quantitepropose' => ['type' => Type::float(), 'description' => 'quantitepropose'],
            'datelivraison' => ['type' => Type::string(), 'description' => 'datelivraison'],

            'prequalification' => ['type' => Type::int(), 'description' => 'prequalification'],
            'statutamm' => ['type' => Type::int(), 'description' => 'statutamm'],
            'presenceechantillon' => ['type' => Type::int(), 'description' => 'presenceechantillon'],
            'presencedossierstech' => ['type' => Type::int(), 'description' => 'presencedossierstech'],
            'observationsaq' => ['type' => Type::string(), 'description' => 'observationsaq'],
            'resultatevaluation' => ['type' => Type::string(), 'description' => 'resultatevaluation'],
            'isselected' => ['type' => Type::int(), 'description' => 'isselected'],
            'score' => ['type' => Type::float(), 'description' => 'score'],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQuerySoumissionarticle($args);
        return $query->get();
    }
}
