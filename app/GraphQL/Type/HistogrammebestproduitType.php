<?php

namespace App\GraphQL\Type;

use App\Models\Detaillivraison;
use App\Models\Pointdevente;
use App\Models\Produit;
use App\Models\RefactoringItems\RefactGraphQLType;
use App\Models\User;
use App\Models\Visite;
use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;


class HistogrammebestproduitType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Histogrammebestproduit',
        'description' => ''
    ];

    public function fields(): array
    {
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'image' => ['type' => Type::string(), 'description' => ''],
                'designation' => ['type' => Type::string(), 'description' => ''],
                'quantiteproduits' => ['type' => Type::int(), 'description' => ''],
                'pourcentage_qte' => ['type' => Type::float(), 'description' => ''],
                'total_produits' => ['type' => Type::int(), 'description' => ''],
                'montant_totals' => ['type' => Type::float(), 'description' => ''],
                'pourcentage' => ['type' => Type::float(), 'description' => ''],
                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }




    // total_produits

    protected function resolveTotalProduitsField($root, $args)
    {
        $total = Detaillivraison::sum('quantite');
        return $total ?? 0;
    }

    // montant_totals

    protected function resolveMontantTotalsField($root, $args)
    {
        $produit = Produit::find($root->id);
        $montant = 0;
        $montant = $produit->detaillivraisons->sum(function ($detaillivraison) {
            return $detaillivraison->quantite * $detaillivraison->produit->prix;
        });
        return $montant ?? 0;
    }

    // pourcentage_mt

    protected function resolvePourcentageField($root, $args)
    {
        $produit = Produit::find($root->id);
        $montant = 0;
        $montant = $produit->detaillivraisons->sum(function ($detaillivraison) {
            return $detaillivraison->quantite * $detaillivraison->produit->prix;
        });

        $total = Detaillivraison::all()->sum(function ($detaillivraison) {
            return $detaillivraison->quantite * $detaillivraison->produit->prix;
        });
        $pourcentage = ($montant / $total) * 100;
        return number_format($pourcentage,2) ?? 0;
    }


    // pourcentage

    protected function resolvePourcentageQteField($root, $args)
    {
        $produit = Produit::find($root->id);
        $quantiteproduits = 0;
        $quantiteproduits = $produit->detaillivraisons->sum('quantite');
        $total = Detaillivraison::sum('quantite');
        $pourcentage = ($quantiteproduits / $total) * 100;
        return $pourcentage ?? 0;
    }


    // quantiteproduits

    protected function resolveQuantiteproduitsField($root, $args)
    {
        $produit = Produit::find($root->id);
        $quantiteproduits = 0;
        $quantiteproduits = $produit->detaillivraisons->sum('quantite');
        return $quantiteproduits ?? 0;
    }
}
