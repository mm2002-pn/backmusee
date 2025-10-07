<?php

namespace App\GraphQL\Type;

use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class RemisedureedevieType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Remisedureedevie',
        'description' => 'Type pour le modèle Remisedureedevie',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'typeduree' => ['type' => Type::int(), 'description' => ''],
            'etat_text' => ['type' => Type::string()],
            'etat_badge' => ['type' => Type::string()],
            'moinsnim' => ['type' => Type::int(), 'description' => ''],
            'moismax' => ['type' => Type::int(), 'description' => ''],
            'remisepourcentage' => ['type' => Type::int(), 'description' => ''],
            'remisevaleur' => ['type' => Type::float(), 'description' => ''],
        ];
    }


    protected function resolveEtatTextField($root, $args)
    {

        $itemArray = array("type" => $root['typeduree']);
        $retour = Outil::donneEtatGeneral("remisedureedevie", $itemArray)['texte'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }

    protected function resolveEtatBadgeField($root, $args)
    {

        $itemArray = array("type" => $root['typeduree']);
        $retour = Outil::donneEtatGeneral("remisedureedevie", $itemArray)['badge'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }
}
