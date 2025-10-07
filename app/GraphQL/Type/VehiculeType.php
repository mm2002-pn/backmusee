<?php

namespace App\GraphQL\Type;

use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class VehiculeType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Vehicule',
        'description' => 'Type pour le modèle Vehicule',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'typevehicule_id' => ['type' => Type::id(), 'description' => ''],
            'matricule' => ['type' => Type::string(), 'description' => ''],
            'marque' => ['type' => Type::string(), 'description' => ''],
            'tonnage_id' => ['type' => Type::id(), 'description' => ''],
            'tonnage' => ['type' =>  GraphQL::type('Tonnage'), 'description' => ''],
            'description' => ['type' => Type::string(), 'description' => ''],
            'volume' => ['type' => Type::float(), 'description' => ''],

            'typevehicule' => ['type' => GraphQL::type('Typevehicule')],
            'tonnage' => ['type' => GraphQL::type('Tonnage')],

            'estinterne' => ['type' => Type::int(), 'description' => ''],
            'etat_text' => ['type' => Type::string(), 'description' => ''],
            'etat_badge' => ['type' => Type::string(), 'description' => ''],
            'parkings' => ['type' => Type::listOf(GraphQL::type('Parking')), 'description' => ''],
            'chauffeur' => ['type' => GraphQL::type('Chauffeur'), 'description' => ''],
            'chauffeur_id' => ['type' => Type::int(), 'description' => ''],


            'created_at' => ['type' => Type::string(), 'description' => ''],
            'updated_at' => ['type' => Type::string(), 'description' => ''],
        ];
    }

    protected function resolveEtatTextField($root, $args)
    {

        $itemArray = array("etat" => $root['estinterne']);
        $retour = Outil::donneEtatGeneral("vehicule", $itemArray)['texte'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }

    protected function resolveEtatBadgeField($root, $args)
    {

        $itemArray = array("etat" => $root['estinterne']);
        $retour = Outil::donneEtatGeneral("vehicule", $itemArray)['badge'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }
}
