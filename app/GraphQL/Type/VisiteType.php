<?php

namespace App\GraphQL\Type;

use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;
use App\Models\Visite;
use App\Models\Zone;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;


class VisiteType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Visite',
        'description' => ''
    ];

    public function fields(): array
    {
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'commercial_id' => ['type' => Type::int(), 'description' => ''],
                'commercial' => ['type' => GraphQL::type('User'), 'description' => ''],
                'pointdevente' => ['type' => GraphQL::type('Pointdevente'), 'description' => ''],
                'pointdevente_id' => ['type' => Type::int(), 'description' => ''],
                'date' => ['type' => Type::string(), 'description' => ''],
                'commentaire' => ['type' => Type::string(), 'description' => ''],
                'planning' => ['type' => GraphQL::type('Planning'), 'description' => ''],
                'planning_id' => ['type' => Type::int(), 'description' => ''],
                'zone_id' => ['type' => Type::int(), 'description' => ''],
                'code' => ['type' => Type::string(), 'description' => ''],
                'totalvente' => ['type' => Type::float(), 'description' => ''],

                'detaillivraisons' => ['type' => Type::listOf(GraphQL::type('Detaillivraison')), 'description' => ''],
                //Detailmateriel
                'detailmateriels' => ['type' => Type::listOf(GraphQL::type('Detailmateriel')), 'description' => ''],
                'demandes' => ['type' => Type::listOf(GraphQL::type('Demande')), 'description' => ''],

                // encaissements
                'encaissements' => ['type' => Type::listOf(GraphQL::type('Encaissement')), 'description' => ''],
                //etatquantité
                'etatquantite' => ['type' => Type::int(), 'description' => ''],
                //etatmateriel
                'etatmateriel' => ['type' => Type::int(), 'description' => ''],
                //etatencaissement
                'etatrecouvrement' => ['type' => Type::int(), 'description' => ''],
                'etatreglement' => ['type' => Type::int(), 'description' => ''],

                // total montant vente
                'total_montant_vente' => ['type' => Type::float(), 'description' => ''],

                

                // total qte vente
                'total_qte_vente' => ['type' => Type::int(), 'description' => ''],
                //antene
                'antenne' => ['type' => Type::string(), 'description' => ''],
                //antene
                'codebl' => ['type' => Type::string(), 'description' => ''],

                //montantencaissement
                'montantencaissement' => ['type' => Type::float(), 'description' => ''],
                'montantencaissement_text' => ['type' => Type::string(), 'description' => ''],

                'isarticlevalidate' => ['type' => Type::string(), 'description' => ''],
                'ismaterielvalidate' => ['type' => Type::string(), 'description' => ''],

                // modepaiement
                'modepaiement' => ['type' => GraphQL::type('Modepaiement'), 'description' => ''],
                'modepaiement_id' => ['type' => Type::int(), 'description' => ''],
                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }

    public function resolveIsarticlevalidateField($root, $args)
    {

        return $root->isarticlevalidate;
    }

    // ismaterielvalidate

    public function resolveIsmaterielvalidateField($root, $args)
    {
        return $root->ismaterielvalidate;
    }

    ///antenne

    public function resolveAntenneField($root, $args)
    {
        $zone = null;
        if ($root->pointdevente && $root->pointdevente->zone) {
            $zone = $root->pointdevente->zone->antenne;
        }
        return $zone ? $zone->code : null;
    }

    // codebl

    public function resolveCodeblField($root, $args)
    {
        dd($root->commercial);
    }


    // code

    public function resolveCodeField($root, $args)
    {
        $code = "BL" . $root->id;
        return $code;
    }


    //montantencaissement_text


    public function resolveMontantencaissementTextField($root, $args)
    {
        $total = $root->montantencaissement;

        if ($total !== null) {
            // Si le montant est entier, on n'affiche pas de décimales
            if (fmod($total, 1) === 0.0) {
                return number_format($total, 0, '', ' ') . ' fcfa';
            }

            // Sinon, on affiche avec 2 décimales
            return number_format($total, 2, ',', ' ') . ' fcfa';
        }

        return 'N/A';
    }


    // public function resolveCommercialField($root, $args)
    public function resolvedZoneIdField($root, $args)
    {
        // rechercher la zone
        $zone = Zone::where('pointdevente_id', $root->pointdevente_id)->first();
        if ($zone) {
            return $zone->id;
        }
        return null;
    }

    // total_montant_vente

    public function resolveTotalMontantVenteField($root, $args)
    {
        // prix * qte
        return $root->detaillivraisons->sum(function ($detaillivraison) {
            return $detaillivraison->produit->prix * $detaillivraison->quantite;
        });
    }

    // total_qte_vente

    public function resolveTotalQteVenteField($root, $args)
    {
        return $root->detaillivraisons->sum('quantite');
    }
}
