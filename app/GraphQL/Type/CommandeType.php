<?php

namespace App\GraphQL\Type;

use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CommandeType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Commande',
        'description' => 'Type pour le modèle Commande',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'datecommande' => ['type' => Type::string(), 'description' => ''],
            'datereception' => ['type' => Type::string(), 'description' => ''],
            'client_id' => ['type' => Type::int(), 'description' => ''],
            'typelivraison_id' => ['type' => Type::int(), 'description' => ''],
            'typelivraison' => ['type' => GraphQL::type('Typelivraison'), 'description' => ''],
            'client' => ['type' => GraphQL::type('Client'), 'description' => ''],
            'statut' => ['type' => Type::int(), 'description' => ''],

            'etat_text' => ['type' => Type::string(), 'description' => ''],
            'etat_badge' => ['type' => Type::string(), 'description' => ''],

            'campagne' => ['type' => GraphQL::type('Campagne'), 'description' => ''],
            'campagne_id' => ['type' => Type::int(), 'description' => ''],


            'detailcommandes' => ['type' => Type::listOf(GraphQL::type('Detailcommande')), 'description' => ''],
        ];
    }

        protected function resolveEtatTextField($root, $args)
        {

            $itemArray = array("etat" => $root['statut']);
            $retour = Outil::donneEtatGeneral("commande", $itemArray)['texte'];
            if (empty($retour)) {
                $retour = "";
            }
            return $retour;
        }

        protected function resolveEtatBadgeField($root, $args)
        {

            $itemArray = array("etat" => $root['statut']);
            $retour = Outil::donneEtatGeneral("commande", $itemArray)['badge'];
            if (empty($retour)) {
                $retour = "";
            }
            return $retour;
        }
}
