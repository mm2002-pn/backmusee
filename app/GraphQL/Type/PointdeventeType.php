<?php

namespace App\GraphQL\Type;

use App\Models\Outil;
use App\Models\Pointdevente;
use App\Models\RefactoringItems\RefactGraphQLType;
use App\Models\Visite;
use App\Models\Zone;
use App\Models\Zonepointdevente;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;


class PointdeventeType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Pointdevente',
        'description' => ''
    ];

    public function fields(): array
    {
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'designation' => ['type' => Type::string(), 'description' => ''],
                'adresse' => ['type' => Type::string(), 'description' => ''],
                'intitule' => ['type' => Type::string(), 'description' => ''],
                'numbcpttier' => ['type' => Type::string(), 'description' => ''],
                'client_id' => ['type' => Type::int(), 'description' => ''],

                // typepointdevente

                'typepointdevente' => ['type' => GraphQL::type('Typepointdevente'), 'description' => ''],
                'typepointdevente_id' => ['type' => Type::int(), 'description' => ''],

                'categoriepointdevente' => ['type' => GraphQL::type('Categoriepointdevente'), 'description' => ''],
                'categoriepointdevente_id' => ['type' => Type::int(), 'description' => ''],

                'clef' => ['type' => Type::string(), 'description' => ''],
                // img_local
                "img_local" => ['type' => Type::string(), 'description' => ''],

                'telephone' => ['type' => Type::string(), 'description' => ''],
                'images' => ['type' => Type::string(), 'description' => ''],
                'email' => ['type' => Type::string(), 'description' => ''],
                'gps' => ['type' => Type::string(), 'description' => ''],
                'client' => ['type' => GraphQL::type('Client'), 'description' => ''],
                'refactid' => ['type' => Type::int(), 'description' => ''],
                'date' => ['type' => Type::string(), 'description' => ''],

                'latitude' => ['type' => Type::string(), 'description' => ''],
                'longitude' => ['type' => Type::string(), 'description' => ''],



                // ventedirect
                'ventedirect' => ['type' => Type::string(), 'description' => ''],

                // etat

                'etat' => ['type' => Type::string(), 'description' => ''],

                'etat_text' => ['type' => Type::string()],
                'etat_badge' => ['type' => Type::string()],

                'zone' => ['type' => GraphQL::type('Zone'), 'description' => ''],
                'zone_id' => ['type' => Type::int(), 'description' => ''],
                'detailmateriels_count' => ['type' => Type::int(), 'description' => ''],
                'detaillivraisons_count' => ['type' => Type::int(), 'description' => ''],
                'reglements_count' => ['type' => Type::int(), 'description' => ''],
                'recouvrements_count' => ['type' => Type::int(), 'description' => ''],
                'visites' => ['type' => Type::listOf(GraphQL::type('Visite')), 'description' => ''],
                'estdivers' => ['type' => Type::int(), 'description' => ''],

                'demandes' => ['type' => Type::listOf(GraphQL::type('Demande')), 'description' => ''],
                'commercial' => ['type' => Type::string(), 'description' => ''],
                'quantiteproduits' => ['type' => Type::int(), 'description' => ''],
                'quantitemateriels' => ['type' => Type::int(), 'description' => ''],
                'date' => ['type' => Type::string(), 'description' => ''],
                'total' => ['type' => Type::int(), 'description' => ''],
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

        $itemArray = array("type" => $root['etat']);
        $retour = Outil::donneEtatGeneral("pointdevente", $itemArray)['texte'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }

    protected function resolveEtatBadgeField($root, $args)
    {

        $itemArray = array("type" => $root['etat']);
        $retour = Outil::donneEtatGeneral("pointdevente", $itemArray)['badge'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }

    protected function resolveTotalField($root, $args)
    {
        //  retourner le nombre total de poin de vente
        return Pointdevente::count();
    }

    protected function resolveQuantiteProduitsField($root, $args)
    {
        $id = $root['id'];
        //dd($id);
        // retouner la dernier visite enregistrer correspondan a 'pointdevente_id'= $this->id
        $visite = Visite::where('pointdevente_id', $id)->orderBy('id', 'desc')->first();
        // retourner le commercial
        if (isset($visite->detaillivraisons)) {
            return $visite->detaillivraisons->count();
        }
    }

    protected function resolveQuantiteMaterielsField($root, $args)
    {
        $id = $root['id'];
        //dd($id);
        // retouner la dernier visite enregistrer correspondan a 'pointdevente_id'= $this->id
        $visite = Visite::where('pointdevente_id', $id)->orderBy('id', 'desc')->first();
        // retourner le commercial
        if (isset($visite->detailmateriels)) {
            return $visite->detailmateriels->count();
        }
    }


    protected function resolveCommercialField($root, $args)
    {
        $id = $root['id'];
        //dd($id);
        // retouner la dernier visite enregistrer correspondan a 'pointdevente_id'= $this->id
        $visite = Visite::where('pointdevente_id', $id)->orderBy('id', 'desc')->first();
        // retourner le commercial
        if (isset($visite->commercial) && isset($visite->commercial->name)) {
            //dd($visite->commercial->name);
            return $visite->commercial->name;
        }
    }

    protected function resolveDateField($root, $args)
    {
        $id = $root['id'];
        //dd($id);
        // retouner la dernier visite enregistrer correspondan a 'pointdevente_id'= $this->id
        $visite = Visite::where('pointdevente_id', $id)->orderBy('id', 'desc')->first();
        if (isset($visite->commercial) && isset($visite->commercial->name)) {
            return $visite->date;
        }
    }


    protected function resolveRefactidField($root, $args)
    {
        return Pointdevente::find($root->id)->id;
    }
}
