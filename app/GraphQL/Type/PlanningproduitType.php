<?php

namespace App\GraphQL\Type;

use App\Models\Planningproduit;
use App\Models\Produit;
use App\Models\RefactoringItems\RefactGraphQLType;
use App\Models\Unite;
use App\Models\Visite;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Facades\DB;

class PlanningproduitType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Planningproduit',
        'description' => ''
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id()],
            'planning_id' => ['type' => Type::int()],
            'produit_id' => ['type' => Type::int()],
            'visite_id' => ['type' => Type::int()],
            'commercial_id' => ['type' => Type::int()],
            'quantite' => ['type' => Type::string()],
            'date' => ['type' => Type::string()],

            'quantiterestante' => ['type' => Type::string()],

            'planning' => ['type' => GraphQL::type('Planning')],
            'produit' => ['type' => GraphQL::type('Produit')],
            'prix_tarifaire' => ['type' => Type::string()],

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

            // Les champs existants que vous souhaitez conserver
            'prixunitaire' => ['type' => Type::string()],
            'prixunitaire_text' => ['type' => Type::string()],
            'totalmontant' => ['type' => Type::string()],
            'totalmontant_text' => ['type' => Type::string()],
            'totalmontantlivre' => ['type' => Type::string()],
            'totalmontantlivre_text' => ['type' => Type::string()],
            'created_at' => ['type' => Type::string()],
            'created_at_fr' => ['type' => Type::string()],
            'updated_at' => ['type' => Type::string()],
            'updated_at_fr' => ['type' => Type::string()],
            'deleted_at' => ['type' => Type::string()],
            'deleted_at_fr' => ['type' => Type::string()],
        ];
    }

    // Résolveurs pour les nouveaux champs

    protected function resolveQuantiteChargeeField($root, $args)
    {
        return $root->quantite;
    }

    protected function resolveQuantiteTotalLivreeField($root, $args)
    {
        $query = Visite::where('planning_id', $root->planning_id)
            ->join('detaillivraisons', 'detaillivraisons.visite_id', '=', 'visites.id')
            ->where('detaillivraisons.produit_id', $root->produit_id);
        // Si une date est passée dans le contexte
        if (isset($root->graphql_args['date'])) {
            $query->whereHas('planning', function ($q) use ($root) {
                $q->where('date', $root->graphql_args['date']);
            });
        }
        $livraisons = $query->select('detaillivraisons.*')->get();

        $total = $livraisons->map(function ($item) {
            $unite = Unite::find($item->unite_id);
            if (!$unite) return $item->quantite;

            if ($unite->ispack == 1) {
                $prod = Produit::find($item->produit_id);
                return $prod ? $item->quantite * $prod->colisage : 0;
            }

            return $item->quantite;
        })->sum();

        return $total;
    }

    protected function resolveQuantiteLivreeCommercialField($root, $args)
    {
        // Si aucun commercial_id n'est spécifié dans la requête, retourner 0
        if (!isset($root->graphql_args['commercial_id'])) {
            return 0;
        }

        $query = Visite::where('planning_id', $root->planning_id)
            ->where('commercial_id', $root->graphql_args['commercial_id'])
            ->join('detaillivraisons', 'detaillivraisons.visite_id', '=', 'visites.id')
            ->where('detaillivraisons.produit_id', $root->produit_id);

        // Filtre par date si présent
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
        if ($root->quantite == 0) return 0;
        return round(($totalLivree / $root->quantite) * 100, 2);
    }

    protected function resolvePourcentageLivraisonCommercialField($root, $args)
    {
        $livreeCommercial = $this->resolveQuantiteLivreeCommercialField($root, $args);
        if ($root->quantite == 0) return 0;
        return round(($livreeCommercial / $root->quantite) * 100, 2);
    }

    // Modifier les résolveurs existants pour utiliser les nouvelles méthodes

    protected function resolveQtelivreField($root, $args)
    {
        // On utilise maintenant quantite_total_livree pour la compatibilité
        return $this->resolveQuantiteTotalLivreeField($root, $args);
    }

    protected function resolveTotalmontantField($root, $args)
    {
        $qte = $this->resolveQuantiteTotalLivreeField($root, $args);
        $pu = $this->resolvePrixunitaireField($root, $args);
        return $qte * $pu;
    }


    protected function resolveTotalmontantTextField($root, $args)
    {
        $total = self::resolveTotalmontantField($root, $args);
        // dd($total);

        if ($total)
            return number_format($total, 2) . 'fcfa';

        return 'N/A';
    }


    protected function resolvePrixunitaireField($root, $args)
    {
        $prd = Produit::find($root->produit_id);
        if (!$prd) {
            return 0;
        }

        return $prd->prix;
    }


    protected function resolveTotalmontantlivreTextField($root, $args)
    {
        $total = self::resolveTotalmontantlivreField($root, $args);

        if ($total !== null) {
            // Si le montant est entier, ne pas afficher de décimales
            if (fmod($total, 1) === 0.0) {
                return number_format($total, 0, '', ' ') . ' fcfa';
            }

            // Sinon, afficher avec 2 décimales
            return number_format($total, 2, ',', ' ') . ' fcfa';
        }

        return 'N/A';
    }


    protected function resolveTotalmontantlivreField($root, $args)
    {
        $planningproduits = Planningproduit::where('planning_id', $root->planning_id)->get();
        if ($planningproduits->isEmpty()) {
            return 0;
        }

        return $planningproduits->sum(function ($pp) {
            return $this->resolveTotalmontantField($pp, []);
        });
    }

    // Resolver method
    protected function resolvePrixunitaireTextField($root, $args)
    {
        if (isset($root['prixunitaire'])) {
            $prix = $root['prixunitaire'];

            // Si le montant est entier, format sans décimales
            if (fmod($prix, 1) === 0.0) {
                return number_format($prix, 0, '', ' ') . ' fcfa';
            }

            // Sinon, format avec 2 décimales
            return number_format($prix, 2, ',', ' ') . ' fcfa';
        }

        return 'N/A';
    }


    // Conserver les autres résolveurs existants...
}
