<?php

namespace App\GraphQL\Type;

use App\Models\Outil;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DetailsdaType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Detailsda',
        'description' => 'Type pour le modèle DA',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'PSHNUM_0' => ['type' => Type::string(), 'description' => ''],
            'CPY_0' => ['type' => Type::string(), 'description' => ''],
            'PSHFCY_0' => ['type' => Type::string(), 'description' => ''],
            'ITMREF_0' => ['type' => Type::string(), 'description' => ''],
            'ITMDES_0' => ['type' => Type::string(), 'description' => ''],
            'BPSNUM_0' => ['type' => Type::string(), 'description' => ''],
            'QTYSTU_0' => ['type' => Type::float(), 'description' => ''],
            'ORDQTYPUU_0' => ['type' => Type::float(), 'description' => ''],
            'ORDQTYSTU_0' => ['type' => Type::float(), 'description' => ''],
            'PUU_0' => ['type' => Type::string(), 'description' => ''],
            'VACBPR_0' => ['type' => Type::string(), 'description' => ''],
            'CUR_0' => ['type' => Type::string(), 'description' => ''],

            'GROPRI_0' => ['type' => Type::float(), 'description' => ''],
            'NETPRI_0' => ['type' => Type::float(), 'description' => ''],
            'PRHFCY_0' => ['type' => Type::string(), 'description' => ''],
            'VAT_0' => ['type' => Type::string(), 'description' => ''],
            'CREUSR_0' => ['type' => Type::string(), 'description' => ''],
            'CREDATTIM_0' => ['type' => Type::string(), 'description' => ''],
            'etat' => ['type' => Type::int(), 'description' => ''],

            'article_id' => ['type' => Type::int(), 'description' => ''],
            'da_id' => ['type' => Type::int(), 'description' => ''],
            'unite_id' => ['type' => Type::int(), 'description' => ''],
            'etat_text' => ['type' => Type::string(), 'description' => ''],

            'margevaleur' => ['type' => Type::int(), 'description' => ''],
            'margepourcentage' => ['type' => Type::int(), 'description' => ''],
            'coeff' => ['type' => Type::float(), 'description' => ''],

            'da' => ['type' => GraphQL::type('Da'), 'description' => ''],
            'article' => ['type' => GraphQL::type('Article'), 'description' => ''],
            'unite' => ['type' => GraphQL::type('Unite'), 'description' => '']

        ];
    }

    protected function resolveEtatTextField($root, $args)
    {
        $etat_text = '';
        if($root['etat'] == 1){
            $etat_text = 'DA';
        }

        return $etat_text;
    }
    protected function resolveMargevaleurField($root, $args)
    {

        return $root['NETPRI_0'] - $root['GROPRI_0'];
    }

    protected function resolveMargepourcentageField($root, $args)
    {
        $valeur = $root['NETPRI_0'] - $root['GROPRI_0'];

        return ($valeur / $root['NETPRI_0']) / 100;
    }

}
