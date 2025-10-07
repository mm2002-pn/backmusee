<?php

namespace App\GraphQL\Type;

use App\Models\Commande;
use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CampagneType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Campagne',
        'description' => 'Type pour le modèle Campagne',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            // Ajouter d'autres champs ici
            'date'  => ['type' => Type::string(), 'description' => ''],
            'datefin'  => ['type' => Type::string(), 'description' => ''],
            'designation'  => ['type' => Type::string(), 'description' => ''],
            'statut'  => ['type' => Type::string(), 'description' => ''],

            'programme'  => ['type' => GraphQL::type('Programme'), 'description' => ''],
            'programme_id'  => ['type' => Type::id(), 'description' => ''],
            // phasedepots
            'phasedepots' => ['type' => Type::listOf(GraphQL::type('Phasedepot')), 'description' => ''],
            'image'  => ['type' => Type::string(), 'description' => ''],

            "lignecommandes" => ['type' => Type::listOf(GraphQL::type('Lignecommande')), 'description' => ''],

            'commandes' => ['type' => Type::listOf(GraphQL::type('Commande')), 'description' => ''],
            'nbrecommades' => ['type' => Type::int(), 'description' => ''],
            'etat_text' => ['type' => Type::string(), 'description' => ''],
            'etat_badge' => ['type' => Type::string(), 'description' => ''],

        ];
    }

    protected function resolveEtatTextField($root, $args)
    {

        $itemArray = array("etat" => $root['statut']);
        $retour = Outil::donneEtatGeneral("campagne", $itemArray)['texte'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }

    protected function resolveEtatBadgeField($root, $args)
    {

        $itemArray = array("etat" => $root['statut']);
        $retour = Outil::donneEtatGeneral("campagne", $itemArray)['badge'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }

    //             'nbrecommades' => ['type' => Type::int(), 'description' => ''],
    public function resolveNbrecommadesField($root, $args)
    {
        return Commande::query()->whereHas('campagne', function ($q) use ($root) {
            $q->where('id', $root->id);
        })->count();
    }

    // datefin
    public function resolveDatefinField($root, $args)
    {
        return $root->datefin;
    }
}
