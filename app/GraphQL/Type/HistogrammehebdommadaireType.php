<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use App\Models\User;
use App\Models\Visite;
use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;


class HistogrammehebdommadaireType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Histogrammehebdommadaire',
        'description' => ''
    ];

    public function fields(): array
    {
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],

                "name" => ['type' => Type::string(), 'description' => ''],
                "date" => ['type' => Type::string(), 'description' => ''],
                "datefin" => ['type' => Type::string(), 'description' => ''],
                'total_comm_visites' => ['type' => Type::int(), 'description' => ''],
                'total_visites' => ['type' => Type::int(), 'description' => ''],
                'pourcentage' => ['type' => Type::float(), 'description' => ''],
                'montant_totals' => ['type' => Type::float(), 'description'],
                'montantcomm_totals' => ['type' => Type::float(), 'description'],

                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }

    // montantcomm_totals
    public function resolveMontantcommTotalsField($root, $args)
    {
        $date = $args['date'] ?? null;
        $datefin = $args['datefin'] ?? null;
        $user_id = $root['id'];
        // Récupérer les visites en fonction des filtres
        $allCommVisites = $this->getVisites($date, $datefin, $user_id);
        // Calculer le montant total
        $mont = $allCommVisites->get()->sum(function ($visite) {
            return $visite->detaillivraisons->sum(function ($detail) {
                return $detail->quantite * $detail->produit->prix;
            });
        });
        return $mont;
    }

    // Montant totals
    public function resolveMontantTotalsField($root, $args)
    {
        $date = $args['date'] ?? null;
        $datefin = $args['datefin'] ?? null;
        $allCommVisites = $this->getVisites($date, $datefin, null);
        $mont = $allCommVisites->get()->sum(function ($visite) {
            return $visite->detaillivraisons->sum(function ($detail) {
                return $detail->quantite * $detail->produit->prix;
            });
        });
        return $mont;
    }



    // pourcentage
    public function resolvePourcentageField($root, $args)
    {
        $totalVisites = $this->resolveTotalVisitesField($root, $args);
        $totalCommVisites = $this->resolveTotalCommVisitesField($root, $args);
        if ($totalVisites == 0) {
            return 0;
        }
        return number_format(($totalCommVisites / $totalVisites) * 100, 2);
    }


    // total_visites
    public function resolveTotalVisitesField($root, $args)
    {
        $date = $root->args['date'] ?? null;
        $datefin = $root->args['datefin'] ?? null;

        $allVisites = $this->getVisites($date, $datefin, null)->count();

        return $allVisites ?? 0;
    }

    // nombre_total
    public function resolveTotalCommVisitesField($root, $args)
    {

        $date = $root->args['date'] ?? null;
        $datefin = $root->args['datefin'] ?? null;
        $user_id = $root['id'];
        $allCommVisites = $this->getVisites($date, $datefin, $user_id)->count();
        return $allCommVisites;
    }

    public function resolveNameField($root, $args)
    {
        $user  = User::find($root['id']);
        return $user->name;
    }

    public function getVisites($date, $datefin, $user_id)
    {
        $query = Visite::query();
        if ($user_id) {
            $query->where('commercial_id', $user_id);
        }

        if ($date && $datefin) {
            $query->whereBetween('date', [$date, $datefin]);
        } elseif ($date) {
            $query->whereDate('date', $date);
        }

        return $query;
    }
}
