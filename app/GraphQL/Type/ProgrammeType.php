<?php

namespace App\GraphQL\Type;

use App\Models\Commande;
use App\Models\Outil;
use App\Models\Programme;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ProgrammeType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Programme',
        'description' => 'Type pour le modèle Programme',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'equipegestion_id' => ['type' => Type::id(), 'description' => ''],
            'objectif' => ['type' => Type::string(), 'description' => ''],
            'missions' => ['type' => Type::string(), 'description' => ''],
            'date' => ['type' => Type::string(), 'description' => ''],
            'statut' => ['type' => Type::string(), 'description' => ''],
            'etat_text' => ['type' => Type::string()],
            'etat_badge' => ['type' => Type::string()],
            'nbre_programmes_en_cours' => ['type' => Type::int(), 'description' => ''],
            'nbre_programmes_termine' => ['type' => Type::int(), 'description' => ''],

            'equipegestion' => ['type' => GraphQL::type("Equipegestion"), 'description' => ''],

            'lignecommandes' => ['type' => Type::listOf(GraphQL::type('Lignecommande')), 'description' => ''],
            'bailleurprogrammes' => ['type' => Type::listOf(GraphQL::type('Bailleurprogramme')), 'description' => ''],
            'nbrecommades' => ['type' => Type::int(), 'description' => ''],

            // campagnes
            'campagnes' => ['type' => Type::listOf(GraphQL::type('Campagne')), 'description' => ''],

        ];
    }


    // nbre commades
    protected function resolveNbrecommadesField($root, $args)
    {
        return Commande::query()->whereHas('campagne', function ($q) use ($root) {
            $q->where('programme_id', $root->id);
        })->count();
    }


    //  nbre_programmes_en_cours
    protected function resolveNbreProgrammesEnCoursField($root, $args)
    {
        // tout les programmes en cours status 0

        return Programme::where('statut', 0)->count();
    }

    //  nbre_programmes_termine
    protected function resolveNbreProgrammesTermineField($root, $args)
    {
        // tout les programmes en cours status 1
        return Programme::where('statut', 2)->count();
    }


    protected function resolveEtatTextField($root, $args)
    {

        $itemArray = array("etat" => $root['statut']);
        $retour = Outil::donneEtatGeneral("programme", $itemArray)['texte'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }

    protected function resolveEtatBadgeField($root, $args)
    {

        $itemArray = array("etat" => $root['statut']);
        $retour = Outil::donneEtatGeneral("programme", $itemArray)['badge'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }
}
