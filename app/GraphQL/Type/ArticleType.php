<?php

namespace App\GraphQL\Type;

use App\Models\Article;
use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ArticleType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Article',
        'description' => 'Type pour le modèle Article',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::int(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'prix' => ['type' => Type::float(), 'description' => ''],
            'quantite' => ['type' => Type::int(), 'description' => ''],
            'description' => ['type' => Type::string(), 'description' => ''],
            'categorie_id' => ['type' => Type::int(), 'description' => ''],
            'image' => ['type' => Type::string(), 'description' => ''],
            'code' => ['type' => Type::string(), 'description' => ''],
            'categorie' => ['type' => GraphQL::type('Categorie'), 'description' => ''],
            'etat_text' => ['type' => Type::string(), 'description' => ''],
            'etat_badge' => ['type' => Type::string(), 'description' => ''],

            'unite_id' => ['type' => Type::int(), 'description' => ''],
            'unite' => ['type' => GraphQL::type('Unite'), 'description' => ''],
            'estactive' => ['type' => Type::int(), 'description' => ''],
            'TCLCOD_0' => ['type' => Type::string(), 'description' => ''],
            'COURTEDUREE_0' => ['type' => Type::int(), 'description' => ''],
            'courteduree_text' => ['type' => Type::string(), 'description' => ''],

            'remise' => ['type' => Type::float(), 'description' => ''],

            'articleremisedureedevies' => ['type' => Type::listOf(GraphQL::type('Articleremisedureedevie')), 'description' => ''],

            'prequalifications' => ['type' => Type::listOf(GraphQL::type('Prequalification')), 'description' => ''],
            'lastprequalification' => ['type' => GraphQL::type('Prequalification'), 'description' => ''],
            'laststatutamm' => ['type' => GraphQL::type('Statutamm'), 'description' => ''],

        ];
    }

    protected function resolveRemiseField($root, $args)
    {
        $article = Article::find($root['id']);
        $moismin = $root->moismin ?? null;
        $moismax = $root->moismax ?? null;
        return  $article->remiseApplicable($moismin, $moismax) ?? 0;
    }

    protected function resolveCourtedureeTextField($root, $args)
    {
        return $root["COURTEDUREE_0"] == 1 ? "Courte durée" : "Normal";
    }



    protected function resolveEtatTextField($root, $args)
    {

        $itemArray = array("etat" => $root['estactive']);
        $retour = Outil::donneEtatGeneral("article", $itemArray)['texte'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }

    protected function resolveEtatBadgeField($root, $args)
    {

        $itemArray = array("etat" => $root['estactive']);
        $retour = Outil::donneEtatGeneral("article", $itemArray)['badge'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }
}
