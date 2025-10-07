<?php

namespace App\GraphQL\Type;

use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;


class DetailmaterielType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Detailmateriel',
        'description' => ''
    ];

    public function fields(): array
    {
        
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'equipement_id' => ['type' => Type::int(), 'description' => ''],
                'type' => ['type' => Type::int(), 'description' => ''],
                'quantite' => ['type' => Type::int(), 'description' => ''],
                'visite_id' => ['type' => Type::int(), 'description' => ''],
                'visite' => ['type' => GraphQL::type('Visite'), 'description' => ''],
                'equipement' => ['type' => GraphQL::type('Equipement'), 'description' => ''],

                'demande' => ['type' => GraphQL::type('Demande'), 'description' => ''],
                'demande_id' => ['type' => Type::int(), 'description' => ''], 
                
                'etat_text' => ['type' => Type::string()],
                'etat_badge'=> ['type' => Type::string()],
                'est_activer' => ['type' => Type::int(), 'description' => ''],


                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }



    protected function resolveEtatTextField($root, $args)
    {

        $itemArray = array("type" => $root['type']);
        $retour = Outil::donneEtatGeneral("detailmateriel", $itemArray)['texte'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }

    protected function resolveEtatBadgeField($root, $args)
    {

        $itemArray = array("type" => $root['type']);
        $retour = Outil::donneEtatGeneral("detailmateriel", $itemArray)['badge'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }
}
