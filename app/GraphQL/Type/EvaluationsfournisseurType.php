<?php

namespace App\GraphQL\Type;

use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class EvaluationsfournisseurType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Evaluationsfournisseur',
        'description' => 'Type pour le modèle Evaluationsfournisseur',
    ];

    public function fields(): array
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
            'etat_text' => ['type' => Type::string()],
            'etat_badge' => ['type' => Type::string()],
            'signatureappro'   => ['type' => Type::string(), 'description' => ''],
            'signaturequality' => ['type' => Type::string(), 'description' => ''],
            'signaturesupply'  => ['type' => Type::string(), 'description' => ''],
            'signaturepharmacist' => ['type' => Type::string(), 'description' => ''],
            'signaturedirector' => ['type' => Type::string(), 'description' => ''],
            'noteevaluations' => [
                'type' => Type::listOf(GraphQL::type('Noteevaluation')),
                'description' => 'Liste des notes d\'évaluation associées',
            ],

            'etatsignatureappro'   => ['type' => Type::int(), 'description' => ''],
            'etatsignaturequality' => ['type' => Type::int(), 'description' => ''],
            'etatsignaturesupply'  => ['type' => Type::int(), 'description' => ''],
            'etatsignaturepharmacist' => ['type' => Type::int(), 'description' => ''],
            'etatsignaturedirector' => ['type' => Type::int(), 'description' => ''],


            'fournisseur'      => ['type' => GraphQL::type('Fournisseur'), 'description' => ''],
            'mesure'           => ['type' => GraphQL::type('Mesure'), 'description' => ''],
            'created_at'       => ['type' => Type::string(), 'description' => 'Date de création'],
            'updated_at'       => ['type' => Type::string(), 'description' => 'Date de mise à jour']

        ];
    }



    protected function resolveEtatTextField($root, $args)
    {
        $itemArray = array("type" => $root['qualification']);
        $retour = Outil::donneEtatGeneral("evaluationsfournisseur", $itemArray)['texte'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }


    // qualification



    protected function resolveEtatBadgeField($root, $args)
    {
        $itemArray = array("type" => $root['qualification']);
        $retour = Outil::donneEtatGeneral("evaluationsfournisseur", $itemArray)['badge'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }
}
