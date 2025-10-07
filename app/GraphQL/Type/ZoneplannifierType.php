<?php

namespace App\GraphQL\Type;

use App\Http\Controllers\Zone;
use App\Models\User;
use App\Models\Outil;
use App\Models\Planning;
use App\Models\Intervention;
use App\Models\Planninguser;
use App\Models\Detaildepense;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Models\RefactoringItems\RefactGraphQLType;
use App\Models\Visite;
use App\Models\Zone as ModelsZone;
use Carbon\Carbon;

class ZoneplannifierType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Zoneplannifier',
        'description' => '',
    ];
    public function fields(): array
    {
        return [
            'id' => ['type' => Type::int()],
            'planning_id' => ['type' => Type::int()],
            'zone_id' => ['type' => Type::int()],
            'planning' => ['type' => GraphQL::type('Planning')],
            'zone' => ['type' => GraphQL::type('Zone')],
            'user_id' => ['type' => Type::int()],
            'user' => ['type' => GraphQL::type('User')],
            'datedebut' =>  ['type' => Type::string()],
            'date' => ['type' => Type::string()],
            'datefin' => ['type' => Type::string()],
            'designation' => ['type' => Type::string()],
            'pointdeventes' => ['type' => Type::int()],
            'recouvrement' => ['type' => Type::string()],
            'etat' => ['type' => Type::int()],
            'pointvisites' => ['type' => Type::int()],
        ];
    }

    protected function resolveUserField($root, $args)
    {
        $planning = Planning::find($root->planning_id);

        if ($planning && isset($planning->user_id)) {
            return User::find($planning->user_id);
        }
        return null;
    }

    protected function resolveUserIdField($root, $args)
    {
        $planning = Planning::find($root->planning_id);

        if ($planning && isset($planning->user_id)) {
            return User::find($planning->user_id)->id;
        }
        return null;
    }


    protected function resolveDatedebutField($root, $args)
    {
        $planning = Planning::find($root->planning_id);

        if ($planning && isset($planning->datesemaine)) {
            return Planning::find($root->planning_id)->datesemaine;
        }
        return null;
    }

    protected function resolveDateField($root, $args)
    {
        $planning = Planning::find($root->planning_id);

        if ($planning && isset($planning->date)) {
            return Planning::find($root->planning_id)->date;
        }
        return null;
    }

    //datefinsemaineen fonction de datedebutsemaine
    protected function resolveDatefinField($root, $args)
    {
        $planning = Planning::find($root->planning_id);

        if ($planning && isset($planning->datesemaine)) {
            $date = Planning::find($root->planning_id)->datesemaine;
            $date = date('Y-m-d', strtotime($date . ' + 6 days'));
            return $date;
        }
        return null;
    }

    protected function resolveDesignationField($root, $args)
    {
        $zone = ModelsZone::find($root->zone_id);

        if ($zone && isset($zone->id)) {
            return ModelsZone::find($root->zone_id)->designation;
        }
        return null;
    }


    protected function resolvePointdeventesField($root, $args)
    {
        return Outil::pointdeventesInfo($root, $args, true);
    }

    //pointvisites
    protected function resolvePointvisitesField($root, $args)
    {
        $planning = Planning::find($root->planning_id);
        $pointdeventes = Outil::pointdeventesInfo($root, $args, false);
       // dd($pointdeventes);
       
        $pointvisites = 0;
        foreach ($pointdeventes as $pointdevente) {
            $visite = Visite::where('pointdevente_id', $pointdevente->pointdevente_id)
            ->where('date', '=', Carbon::now())->first();
            if ($visite && isset($visite->id)) {
                $pointvisites++;
            }
        }
        

        return $pointvisites; 
    }
}
