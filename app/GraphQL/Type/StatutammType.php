<?php

namespace App\GraphQL\Type;

use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class StatutammType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Statutamm',
        'description' => 'Type pour le modèle Statutamm',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],

            'article' => ['type' => GraphQL::type('Article'), 'description' => 'article'],


            'article_id' => ['type' => Type::id(), 'description' => 'article_id'],

            'designationsalama' => ['type' => Type::string(), 'description' => ''],
            'nomcommercial' => ['type' => Type::string(), 'description' => ''],
            'nomfournisseur' => ['type' => Type::string(), 'description' => ''],

            'laboratoiretitulaire' => ['type' => Type::string(), 'description' => ''],
            'laboratoirefabriquant' => ['type' => Type::string(), 'description' => ''],
            'numeroamm' => ['type' => Type::string(), 'description' => ''],
            'statutamm' => ['type' => Type::string(), 'description' => ''],
            'dateexpirationamm' => ['type' => Type::string(), 'description' => ''],
            'datedelivranceamm' => ['type' => Type::string(), 'description' => ''],

            'dateexpiration' => ['type' => Type::string(), 'description' => ''],
            'datedelivrance' => ['type' => Type::string(), 'description' => ''],

            'fournisseur' => ['type' => GraphQL::type('Fournisseur'), 'description' => ''],
            'codeproduit' => ['type' => Type::string(), 'description' => ''],
            'fournisseur_id' => ['type' => Type::int(), 'description' => ''],

            'statutenregistrement' => ['type' => Type::int(), 'description' => ''],
            'etat_text' => ['type' => Type::string()],
            'etat_badge' => ['type' => Type::string()],

            'laboratoiretitulaire_id' => ['type' => Type::int(), 'description' => ''],
            'laboratoirefabriquant_id' => ['type' => Type::int(), 'description' => ''],
            'labotitulaire' => ['type' => GraphQL::type('Fabricant'), 'description' => ''],
            'labofabricant' => ['type' => GraphQL::type('Fabricant'), 'description' => ''],

            'created_at' => ['type' => Type::string(), 'description' => ''],
            'updated_at' => ['type' => Type::string(), 'description' => ''],

        ];
    }

    protected function resolveEtatTextField($root, $args)
    {
        $itemArray = array("type" => $root['statutenregistrement']);
        $retour = Outil::donneEtatGeneral("statutamm", $itemArray)['texte'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }
    // statutenregistrement
    protected function resolveEtatBadgeField($root, $args)
    {
        $itemArray = array("type" => $root['statutenregistrement']);
        $retour = Outil::donneEtatGeneral("statutamm", $itemArray)['badge'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }


    // dateexpiration jj/mm/aaaa
    protected function resolveDateexpirationField($root, $args)
    {
        return date('d/m/Y', strtotime($root['dateexpiration']));
    }
    // datedelivrance jj/mm/aaaa
    protected function resolveDatedelivranceField($root, $args)
    {
        return date('d/m/Y', strtotime($root['datedelivrance']));
    }

}
