<?php

namespace App\GraphQL\Type;

use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class PrequalificationType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Prequalification',
        'description' => 'Type pour le modèle Prequalification',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            //anneeprequalification
            'anneeprequalification' => ['type' => Type::int(), 'description' => ''],
            //anneeexpiration
            'anneeexpiration' => ['type' => Type::int(), 'description' => ''],
            //referenceaoip
            'referenceaoip' => ['type' => Type::string(), 'description' => ''],
            //code
            'code' => ['type' => Type::string(), 'description' => ''],
            //type
            'type' => ['type' => Type::string(), 'description' => ''],
            //denomination
            'denomination' => ['type' => Type::string(), 'description' => ''],
            //cdt
            'cdt' => ['type' => Type::string(), 'description' => ''],
            //statut
            'statut' => ['type' => Type::int(), 'description' => ''],
            'etat_text' => ['type' => Type::string()],
            'etat_badge' => ['type' => Type::string()],
            // fournisseur_id
            'fournisseur_id' => ['type' => Type::int(), 'description' => ''],

            'fabriquant'  => ['type' => Type::string(), 'description' => ''],

            'fabricant_id'  => ['type' => Type::int(), 'description' => ''],
            
            'fabricant'  => ['type' => GraphQL::type('Fabricant'), 'description' => ''],


            'article_id'  => ['type' => Type::int(), 'description' => ''],
            
            'article'  => ['type' => GraphQL::type('Article'), 'description' => ''],




            // adresse
            'adresse' => ['type' => Type::string(), 'description' => ''],

            // pays_id
            'pays_id' => ['type' => Type::int(), 'description' => ''],

            // dateprequalification
            'dateprequalification' => ['type' => Type::string(), 'description' => ''],


            'pays' => ['type' => GraphQL::type('Pays'), 'description' => ''],

            'fournisseur' => ['type' => GraphQL::type('Fournisseur'), 'description' => ''],
            //created_at
            'created_at' => ['type' => Type::string(), 'description' => ''],
            //updated_at
            'updated_at' => ['type' => Type::string(), 'description' => ''],
        ];
    }



    protected function resolveEtatTextField($root, $args)
    {
        $itemArray = array("type" => $root['statut']);
        $retour = Outil::donneEtatGeneral("prequalification", $itemArray)['texte'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }


    // statut



    protected function resolveEtatBadgeField($root, $args)
    {
        $itemArray = array("type" => $root['statut']);
        $retour = Outil::donneEtatGeneral("prequalification", $itemArray)['badge'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }
}
