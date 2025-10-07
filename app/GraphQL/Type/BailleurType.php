<?php

namespace App\GraphQL\Type;

use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class BailleurType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Bailleur',
        'description' => 'Type pour le modèle Bailleur',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'nom' => ['type' => Type::string(), 'description' => ''],
            'pays' => ['type' => Type::string(), 'description' => ''],
            'contact' => ['type' => Type::string(), 'description' => ''],
            'emailcontact' => ['type' => Type::string(), 'description' => ''],
            'telephone' => ['type' => Type::string(), 'description' => ''],
            'fax' => ['type' => Type::string(), 'description' => ''],
            'fixe' => ['type' => Type::string(), 'description' => ''],
            'etat_text' => ['type' => Type::string(), 'description' => ''],
            'etat_badge' => ['type' => Type::string(), 'description' => ''],
            'estactive' => ['type' => Type::int(), 'description' => ''],

            'user' => ['type' => GraphQL::type('User'), 'description' => ''],
            'user_id' => ['type' => Type::int(), 'description' => ''],
        ];
    }
    protected function resolveEtatTextField($root, $args)
    {

        $itemArray = array("etat" => $root['estactive']);
        $retour = Outil::donneEtatGeneral("bailleur", $itemArray)['texte'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }

    protected function resolveEtatBadgeField($root, $args)
    {

        $itemArray = array("etat" => $root['estactive']);
        $retour = Outil::donneEtatGeneral("bailleur", $itemArray)['badge'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }
}
