<?php

namespace App\GraphQL\Type;

use App\Models\Evaluationsfournisseur;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class FournisseurType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Fournisseur',
        'description' => 'Type pour le modèle Fournisseur',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::int(), 'description' => ''],
            'email' => ['type' => Type::string(), 'description' => ''],
            'code' => ['type' => Type::string(), 'description' => ''],
            'nom' => ['type' => Type::string(), 'description' => ''],
            'adresse' => ['type' => Type::string(), 'description' => ''],
            'telephone' => ['type' => Type::string(), 'description' => ''],
            'typefournisseur_id' => ['type' => Type::int(), 'description' => ''],
            'categoriefournisseur_id' => ['type' => Type::int(), 'description' => ''],
            'score' => ['type' => Type::string(), 'description' => ''],
            'annee' => ['type' => Type::string(), 'description'],
            'typefournisseur' => ['type' => GraphQL::type('Typefournisseur'), 'description' => ''],
            'categoriefournisseur' => ['type' => GraphQL::type('Categoriefournisseur'), 'description' => ''],
            'evaluationsfournisseurs' => ['type' => Type::listOf(GraphQL::type('Evaluationsfournisseur')), 'description' => ''],
            'TSSCOD_0_0_id' => ['type' => Type::int(), 'description' => ''],
            'TSSCOD_0_0' => ['type' => Type::string(), 'description' => ''],
            'parkings' => ['type' => Type::listOf(GraphQL::type('Parking')), 'description' => ''],
        ];
    }


    public function resolveScoreField($root, $args)
    {
        $id = $root->id;
        // recupérer la dernière évaluation du fournisseur de la dernier année qui a une qualification  dans Evaluationsfournisseur y'a annnee , et fournisseur_id

        $evaluation = Evaluationsfournisseur::where('fournisseur_id', $id)
            ->orderBy('annee', 'desc')
            ->first();

        if (!empty($evaluation)) {
            return $evaluation['finalscore'];
        } else {
            return 0;
        }
    }


       public function resolveAnneeField($root, $args)
    {
        $id = $root->id;

        $evaluation = Evaluationsfournisseur::where('fournisseur_id', $id)
            ->orderBy('annee', 'desc')
            ->first();

        if (!empty($evaluation)) {
            return $evaluation['annee'];
        } else {
            return 0;
        }
    }


}
