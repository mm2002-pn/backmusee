<?php

namespace App\GraphQL\Type;

use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;


class BlType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Bl',
        'description' => ''
    ];

    public function fields(): array
    {

        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'commercial' => ['type' => GraphQL::type('User'), 'description' => ''],
                'commercial_id' => ['type' => Type::int(), 'description' => ''],

                'date' => ['type' => Type::string(), 'description' => ''],
                'datedebut' => ['type' => Type::string(), 'description' => ''],
                'dateenvoie' => ['type' => Type::string(), 'description' => ''],
                'datefin' => ['type' => Type::string(), 'description' => ''],

                // datedebutperiode
                'datedebutperiode' => ['type' => Type::string(), 'description' => ''],

                // datefinperiode
                'datefinperiode' => ['type' => Type::string(), 'description' => ''],



                'detailbls' => ['type' => Type::listOf(GraphQL::type('Detailbl')), 'description' => ''],
                'total_montant_vente' => ['type' => Type::float(), 'description' => ''],
                'code' => ['type' => Type::string(), 'description' => ''],
                'issend' => ['type' => Type::int(), 'description' => ''],
                'etat_text' => ['type' => Type::string()],
                'etat_badge' => ['type' => Type::string()],
                'total_qte_vente' => ['type' => Type::int(), 'description' => ''],
                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }

    // datedebut

    protected function resolveDatedebutField($root, $args)
    {
        return $root->datedebut;
    }

    protected function resolveDatefinField($root, $args)
    {
        return $root->datedebut;
    }


    protected function resolveEtatTextField($root, $args)
    {

        $itemArray = array("type" => $root['issend']);
        $retour = Outil::donneEtatGeneral("bl", $itemArray)['texte'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }

    protected function resolveEtatBadgeField($root, $args)
    {

        $itemArray = array("type" => $root['issend']);
        $retour = Outil::donneEtatGeneral("bl", $itemArray)['badge'];
        if (empty($retour)) {
            $retour = "";
        }
        return $retour;
    }

    // total_montant_vente

    public function resolveTotalMontantVenteField($root, $args)
    {
        return $root->detailbls->sum(function ($detailbl) {
            return $detailbl->produit->prix * $detailbl->quantite;
        });
    }

    // total_qte_vente
    public function resolveTotalQteVenteField($root, $args)
    {
        return $root->detailbls->sum('quantite');
    }
}
