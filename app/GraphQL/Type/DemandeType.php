<?php

namespace App\GraphQL\Type;

use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;


class DemandeType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Demande',
        'description' => ''
    ];

    public function fields(): array
    {

        
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'commercial_id' => ['type' => Type::int(), 'description' => ''],
                'pointdevente_id' => ['type' => Type::int(), 'description' => ''],
                'date' => ['type' => Type::string(), 'description' => ''],
                'etat' => ['type' => Type::int(), 'description' => ''],
                'commercial' => ['type' => GraphQL::type('User'), 'description' => ''],

                'etat_text' => ['type' => Type::string()],
                'etat_badge'=> ['type' => Type::string()],

                'pointdevente' => ['type' => GraphQL::type('Pointdevente'), 'description' => ''],
                'detailmateriels' => ['type' => Type::listOf(GraphQL::type('Detailmateriel')), 'description' => ''],


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

        $itemArray = array("etat" => $root['etat']);
        $retour = Outil::donneEtatGeneral("demande", $itemArray)['texte'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }

    protected function resolveEtatBadgeField($root, $args)
    {

        $itemArray = array("etat" => $root['etat']);
        $retour = Outil::donneEtatGeneral("demande", $itemArray)['badge'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }

}
