<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class EvaluationsfournisseursQuery extends Query
{
    protected $attributes = [
        'name' => 'evaluationsfournisseurs',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Evaluationsfournisseur'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'fournisseur_id'    => ['type' => Type::int(), 'description' => ''],
            'mesure_id'        => ['type' => Type::int(), 'description' => ''],
            'annee'            => ['type' => Type::int(), 'description' => ''],
            'delailivraison'   => ['type' => Type::float(), 'description' => ''],
            'desistement'      => ['type' => Type::float(), 'description' => 'Désistement'],
            'conformitetechnique' => ['type' => Type::float(), 'description' => 'Conformité technique'],
            'reclamation'      => ['type' => Type::float(), 'description' => 'Réclamations'],
            'reponsesreclamation' => ['type' => Type::float(), 'description' => 'Réponses réclamations'],
            'controlmarketing' => ['type' => Type::float(), 'description' => 'Contrôle post marketing'],
            'totalnotes'       => ['type' => Type::float(), 'description' => ''],
            'totalweighted'    => ['type' => Type::float(), 'description' => ''],
            'finalscore'       => ['type' => Type::string(), 'description' => ''],
            'qualification'    => ['type' => Type::int(), 'description' => ''],
            'signatureappro'   => ['type' => Type::string(), 'description' => ''],
            'signaturequality' => ['type' => Type::string(), 'description' => ''],
            'signaturesupply'  => ['type' => Type::string(), 'description' => ''],
            'signaturepharmacist' => ['type' => Type::string(), 'description' => ''],
            'signaturedirector' => ['type' => Type::string(), 'description' => ''],
               'etatsignatureappro'   => ['type' => Type::int(), 'description' => ''],
            'etatsignaturequality' => ['type' => Type::int(), 'description' => ''],
            'etatsignaturesupply'  => ['type' => Type::int(), 'description' => ''],
            'etatsignaturepharmacist' => ['type' => Type::int(), 'description' => ''],
            'etatsignaturedirector' => ['type' => Type::int(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryEvaluationsfournisseur($args);
        return $query->get();
    }
}
