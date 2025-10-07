<?php

namespace App\GraphQL\Type;

use App\Models\Equipement;
use App\Models\Planningequipement;
use App\Models\RefactoringItems\RefactGraphQLType;
use App\Models\Visite;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Facades\DB;

class PlanningequipementType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Planningequipement',
        'description' => ''
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id()],
            'planning_id' => ['type' => Type::int()],
            'equipement_id' => ['type' => Type::int()],
            'visite_id' => ['type' => Type::int()],
            'commercial_id' => ['type' => Type::int()],
            'quantite' => ['type' => Type::string()],
            'quantiterestante' => ['type' => Type::string()],

            'planning' => ['type' => GraphQL::type('Planning')],
            'equipement' => ['type' => GraphQL::type('Equipement')],

            // Quantité chargée initialement
            'quantite_chargee' => ['type' => Type::string()],

            // Quantité totale livrée (tous commerciaux)
            'quantite_total_livree' => ['type' => Type::string()],

            // Quantité livrée par le commercial spécifié
            'quantite_livree_commercial' => ['type' => Type::string()],

            // Delta (quantité chargée - quantité livrée totale)
            'delta' => ['type' => Type::string()],

            // Delta commercial (quantité chargée - quantité livrée par le commercial)
            'delta_commercial' => ['type' => Type::string()],

            // Pourcentage de livraison total
            'pourcentage_livraison' => ['type' => Type::string()],

            // Pourcentage de livraison pour le commercial
            'pourcentage_livraison_commercial' => ['type' => Type::string()],

            // Prix et montants
            'prixunitaire' => ['type' => Type::string()],
            'prixunitaire_text' => ['type' => Type::string()],
            'totalmontant' => ['type' => Type::string()],
            'totalmontant_text' => ['type' => Type::string()],
            'totalmontantlivre' => ['type' => Type::string()],
            'totalmontantlivre_text' => ['type' => Type::string()],

            // Dates
            'created_at' => ['type' => Type::string()],
            'created_at_fr' => ['type' => Type::string()],
            'updated_at' => ['type' => Type::string()],
            'updated_at_fr' => ['type' => Type::string()],
            'deleted_at' => ['type' => Type::string()],
            'deleted_at_fr' => ['type' => Type::string()],
        ];
    }

    // ============ RESOLVEURS ============

    protected function resolveQuantiteChargeeField($root, $args)
    {
        return $root->quantite;
    }

    protected function resolveQuantiteTotalLivreeField($root, $args)
    {
        $query = Visite::where('planning_id', $root->planning_id)
            ->join('detaillivraisons', 'detaillivraisons.visite_id', '=', 'visites.id')
            ->where('detaillivraisons.equipement_id', $root->equipement_id);

        if (isset($root->graphql_args['date'])) {
            $query->whereHas('planning', function ($q) use ($root) {
                $q->where('date', $root->graphql_args['date']);
            });
        }

        return $query->sum('detaillivraisons.quantite') ?? 0;
    }

    protected function resolveQuantiteLivreeCommercialField($root, $args)
    {
        if (!isset($root->graphql_args['commercial_id'])) {
            return 0;
        }

        $query = Visite::where('planning_id', $root->planning_id)
            ->where('commercial_id', $root->graphql_args['commercial_id'])
            ->join('detaillivraisons', 'detaillivraisons.visite_id', '=', 'visites.id')
            ->where('detaillivraisons.equipement_id', $root->equipement_id);

        if (isset($root->graphql_args['date'])) {
            $query->whereHas('planning', function ($q) use ($root) {
                $q->where('date', $root->graphql_args['date']);
            });
        }

        return $query->sum('detaillivraisons.quantite') ?? 0;
    }

    protected function resolveDeltaField($root, $args)
    {
        $totalLivree = $this->resolveQuantiteTotalLivreeField($root, $args);
        return $root->quantite - $totalLivree;
    }

    protected function resolveDeltaCommercialField($root, $args)
    {
        $livreeCommercial = $this->resolveQuantiteLivreeCommercialField($root, $args);
        return $root->quantite - $livreeCommercial;
    }

    protected function resolvePourcentageLivraisonField($root, $args)
    {
        $totalLivree = $this->resolveQuantiteTotalLivreeField($root, $args);
        return $root->quantite > 0 ? round(($totalLivree / $root->quantite) * 100, 2) : 0;
    }

    protected function resolvePourcentageLivraisonCommercialField($root, $args)
    {
        $livreeCommercial = $this->resolveQuantiteLivreeCommercialField($root, $args);
        return $root->quantite > 0 ? round(($livreeCommercial / $root->quantite) * 100, 2) : 0;
    }

    // ============ RESOLVEURS EXISTANTS MODIFIES ============

    protected function resolveQtelivreField($root, $args)
    {
        return $this->resolveQuantiteTotalLivreeField($root, $args);
    }

    protected function resolvePrixunitaireField($root, $args)
    {
        $equipement = Equipement::find($root->equipement_id);
        return $equipement ? $equipement->prix : 0;
    }

    protected function resolvePrixunitaireTextField($root, $args)
    {
        $prix = $this->resolvePrixunitaireField($root, $args);

        if (fmod($prix, 1) === 0.0) {
            return number_format($prix, 0, '', ' ') . ' fcfa';
        }

        return number_format($prix, 2, ',', ' ') . ' fcfa';
    }

    protected function resolveTotalmontantField($root, $args)
    {
        $qte = $this->resolveQuantiteTotalLivreeField($root, $args);
        $pu = $this->resolvePrixunitaireField($root, $args);
        return $qte * $pu;
    }

    protected function resolveTotalmontantTextField($root, $args)
    {
        $total = $this->resolveTotalmontantField($root, $args);
        return $total ? number_format($total, 2, ',', ' ') . ' fcfa' : 'N/A';
    }

    protected function resolveTotalmontantlivreField($root, $args)
    {
        $planningequipements = Planningequipement::where('planning_id', $root->planning_id)->get();
        return $planningequipements->sum(function ($pe) {
            return $this->resolveTotalmontantField($pe, []);
        });
    }

    protected function resolveTotalmontantlivreTextField($root, $args)
    {
        $total = $this->resolveTotalmontantlivreField($root, $args);

        if (fmod($total, 1) === 0.0) {
            return number_format($total, 0, '', ' ') . ' fcfa';
        }

        return number_format($total, 2, ',', ' ') . ' fcfa';
    }
}
