<?php

namespace App\GraphQL\Type;

use App\Models\Da;
use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DaType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Da',
        'description' => 'Type pour le modèle DA',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'PSHNUM_0' => ['type' => Type::string(), 'description' => ''],
            'CPY_0' => ['type' => Type::string(), 'description' => ''],
            'PSHFCY_0' => ['type' => Type::string(), 'description' => ''],
            'PRQDAT_0' => ['type' => Type::string(), 'description' => ''],
            'USR_0' => ['type' => Type::string(), 'description' => ''],
            'REQUSR_0' => ['type' => Type::string(), 'description' => ''],
            'CREUSR_0' => ['type' => Type::string(), 'description' => ''],
            'CREDATTIM_0' => ['type' => Type::string(), 'description' => ''],
            'date' => ['type' => Type::string(), 'description' => ''],
            'YTYPEPASS_0' => ['type' => Type::int(), 'description' => ''],
            'YCOM_0' => ['type' => Type::string(), 'description' => ''],
            'YSERVICE_0' => ['type' => Type::string(), 'description' => ''],
            'typemarche_id' => ['type' => Type::int(), 'description' => ''],
            'user_id' => ['type' => Type::int(), 'description' => ''],
            'demandeur_id' => ['type' => Type::int(), 'description' => ''],
            'preparateur_id' => ['type' => Type::int(), 'description' => ''],
            'etat' => ['type' => Type::int(), 'description' => ''],
            'etat_text' => ['type' => Type::string(), 'description' => ''],
            'etat_badge' => ['type' => Type::string(), 'description' => ''],
            'etatdao' => ['type' => Type::int(), 'description' => ''],
            'etatdao_text' => ['type' => Type::string(), 'description' => ''],

            'etatdaofournisseur' => ['type' => Type::int(), 'description' => ''],
            'etatdaofournisseur_text' => ['type' => Type::string(), 'description' => ''],
            'datepub' => ['type' => Type::string(), 'description' => ''],
            'dateouvertureoffre' => ['type' => Type::string(), 'description' => ''],
            'datecloture' => ['type' => Type::string(), 'description' => ''],
            'TSSCOD_0_0' => ['type' => Type::string(), 'description' => ''],

            'typemarche' => ['type' => GraphQL::type('Typemarche'), 'description' => ''],
            'user' => ['type' => GraphQL::type('User'), 'description' => ''],
            'demandeur' => ['type' => GraphQL::type('User'), 'description' => ''],
            'preparateur' => ['type' => GraphQL::type('User'), 'description' => ''],

            'dadocumentspecifications' => ['type' => Type::listOf(GraphQL::type('Dadocumentspecification')), 'description' => ''],
            'daevenements' => ['type' => Type::listOf(GraphQL::type('Daevenement')), 'description' => ''],
        ];
    }

    protected function resolveEtatTextField($root, $args)
    {

        return Outil::resolveEtatDaTextField($root['etat'], $root['YTYPEPASS_0']);
    }

    protected function resolveEtatdaoTextField($root, $args)
    {
        return Outil::resolveEtatsectionTextField($root['etatdao']);
    }
    protected function resolveEtatdaofournisseurTextField($root, $args)
    {
        return Outil::resolveEtatsectionTextField($root['etatdaofournisseur']);
    }

    protected function resolveEtatBadgeField($root, $args)
    {
        $etat_badge = '';
        if ($root['etat'] == 1) {
            $etat_badge = 'bg-danger';
        }
        return $etat_badge;
    }
}
