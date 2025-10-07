<?php

namespace App\GraphQL\Type;

use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;
use App\Models\Soumission;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class SoumissionType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Soumission',
        'description' => 'Type pour le modèle Soumission',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],

            'date' => ['type' => Type::string(), 'description' => ''],
            'score' => ['type' => Type::float(), 'description' => ''],
            'statut' => ['type' => Type::int(), 'description' => ''],
            'isbc' => ['type' => Type::int(), 'description' => ''],
            'iscontrat' => ['type' => Type::int(), 'description' => ''],
            'urlbc' => ['type' => Type::string(), 'description' => ''],
            'urlcontrat' => ['type' => Type::string(), 'description' => ''],
            'ao_id' => ['type' => Type::id(), 'description' => ''],
            'fournisseur_id' => ['type' => Type::id(), 'description' => ''],
            'datecontrat' =>   ['type' => Type::string(), 'description' => ''],
            'nomcontrat' =>   ['type' => Type::string(), 'description' => ''],
            'commitevalidate' => ['type' => Type::id(), 'description' => ''],
            'etatcontractel' => ['type' => Type::id(), 'description' => ''],
            'etat_text' => ['type' => Type::string()],
            'etat_badge' => ['type' => Type::string()],

            'isarticletemplate' => ['type' => Type::int(), 'description' => ''],

            'ao' => ['type' => GraphQL::type('Ao'), 'description' => ''],
            'fournisseur' => ['type' => GraphQL::type('Fournisseur'), 'description' => ''],
            'soumissionarticles' => ['type' =>  Type::listOf(GraphQL::type('Soumissionarticle')), 'description' => ''],
        ];
    }


    // isarticletemplate
    // isarticletemplate
    protected function resolveIsarticletemplateField($root, $args)
    {
        // Récupérer la soumission avec ses articles
        $soumission = Soumission::with('soumissionarticles.article.categorie')->find($root["id"]);
        if (!$soumission || $soumission->soumissionarticles->isEmpty()) {
            return 0;
        }
        // Vérifier si tous les articles sont de catégorie "MEDIC"
        $allMedic = $soumission->soumissionarticles->every(function ($soumissionArticle) {
            return isset($soumissionArticle->article->categorie)
                && strtoupper($soumissionArticle->article->categorie->designation) === "MEDIC";
        });


        return $allMedic ? 1 : 0;
    }


    protected function resolveEtatTextField($root, $args)
    {

        $itemArray = array("type" => $root['commitevalidate']);
        $retour = Outil::donneEtatGeneral("soumission", $itemArray)['texte'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }

    protected function resolveEtatBadgeField($root, $args)
    {

        $itemArray = array("type" => $root['commitevalidate']);
        $retour = Outil::donneEtatGeneral("soumission", $itemArray)['badge'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }
}
