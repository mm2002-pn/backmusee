<?php

namespace App\GraphQL\Type;

use App\Models\Ao;
use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AoType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Ao',
        'description' => 'Type pour le modèle Ao',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'date' => ["type" => Type::string(), 'descrition' => ''],
            'reference' => ["type" => Type::string(), 'descrition' => ''],
            'designation' => ["type" => Type::string(), 'descrition' => ''],
            'typemarche_id' => ["type" => Type::string(), 'descrition' => ''],
            'typeprocedure_id' => ["type" => Type::string(), 'descrition' => ''],
            'datepublication' => ["type" => Type::string(), 'descrition' => ''],
            'datecloture' => ["type" => Type::string(), 'descrition' => ''],
            'dateouvertureoffre' => ["type" => Type::string(), 'descrition' => ''],
            'typeprocedure' => ['type' => GraphQL::type('Typeprocedure'), 'description' => ''],
            'typemarche' => ['type' => GraphQL::type('Typemarche'), 'description' => ''],
            'aoarticles'  => ['type' => Type::listOf(GraphQL::type('Aoarticle')), 'description' => ''],
            'aofournisseurs'  =>  ['type' => Type::listOf(GraphQL::type('Aofournisseur')), 'description' => ''],
            'statut' => ['type' => Type::int(), 'description' => ''],
            'etat_text' => ['type' => Type::string()],
            'etat_badge' => ['type' => Type::string()],
            'da_id' => ['type' => Type::int()],
            'soumissions'  => ['type' => Type::listOf(GraphQL::type('Soumission')), 'description' => ''],
            'da' => ['type' => GraphQL::type('Da'), 'description' => ''],
            'TSSCOD_0_0' => ["type" => Type::string(), 'descrition' => ''],
            'targetpricestatus' => ["type" => Type::int(), 'descrition' => ''],
            'isarticletemplate' => ['type' => Type::int(), 'description' => ''],


            'isnotationfournisseur' => ['type' => Type::int(), 'description' => ''],
            'urlnotationfournisseur' => ['type' => Type::string(), 'description' => ''],

            'isnotationarticle' => ['type' => Type::int(), 'description' => ''],
            'urlnotationarticle' => ['type' => Type::string(), 'description' => ''],

            'isnotationadministrative' => ['type' => Type::int(), 'description' => ''],
            'urlnotationadministrative' => ['type' => Type::string(), 'description' => ''],
            'attachments'  => ['type' => Type::listOf(GraphQL::type('Attachement')), 'description' => ''],


        ];
    }

      protected function resolveIsarticletemplateField($root, $args)
    {
        // Récupérer la soumission avec ses articles
        $ao = Ao::with('aoarticles.article.categorie')->find($root["id"]);
        if (!$ao || $ao->aoarticles->isEmpty()) {
            return 0;
        }
        // Vérifier si tous les articles sont de catégorie "MEDIC"
        $allMedic = $ao->aoarticles->every(function ($soumissionArticle) {
            return isset($soumissionArticle->article->categorie)
                && strtoupper($soumissionArticle->article->categorie->designation) === "MEDIC";
        });


        return $allMedic ? 1 : 0;
    }

    protected function resolveEtatTextField($root, $args)
    {

        $itemArray = array("type" => $root['statut']);
        $retour = Outil::donneEtatGeneral("ao", $itemArray)['texte'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }

    protected function resolveTargetpricestatusField($root, $args)
    {
        return 1;
        
       // return Outil::getEtatTargetPriceAo($root['id']);
    }

    protected function resolveEtatBadgeField($root, $args)
    {

        $itemArray = array("type" => $root['statut']);
        $retour = Outil::donneEtatGeneral("ao", $itemArray)['badge'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }
}
