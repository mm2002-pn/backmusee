<?php

namespace App\GraphQL\Type;

use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class FicheevaluationType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Ficheevaluation',
        'description' => 'Type pour le modèle Ficheevaluation',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'annee' => ['type' => Type::int(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'isactive' => ['type' => Type::int(), 'description' => ''],
            'TSSCOD_0_0' => ['type' => Type::string(), 'description' => ''],
            'etat_text' => ['type' => Type::string()],
            'etat_badge' => ['type' => Type::string()],
            'workflows' => ['type' => Type::listOf(GraphQL::type('Workflow')), 'description' => ''],
            'fichecriteres' => ['type' => Type::listOf(GraphQL::type('Fichecritere')), 'description' => ''],
            'modelfiche'  => ['type' => Type::int(), 'description' => ''],
        ];
    }


    protected function resolveEtatTextField($root, $args)
    {

        $itemArray = array("type" => $root['TSSCOD_0_0']);
        $retour = Outil::donneEtatGeneral("ficheevaluation", $itemArray)['texte'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }

    protected function resolveEtatBadgeField($root, $args)
    {

        $itemArray = array("type" => $root['TSSCOD_0_0']);
        $retour = Outil::donneEtatGeneral("ficheevaluation", $itemArray)['badge'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }
}
