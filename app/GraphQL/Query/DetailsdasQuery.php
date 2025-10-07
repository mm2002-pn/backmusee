<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DetailsdasQuery extends Query
{
    protected $attributes = [
        'name' => 'detailsdas',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Detailsda'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'PSHNUM_0' => ['type' => Type::string(), 'description' => ''],
            'CPY_0' => ['type' => Type::string(), 'description' => ''],
            'PSHFCY_0' => ['type' => Type::string(), 'description' => ''],
            'ITMREF_0' => ['type' => Type::string(), 'description' => ''],
            'ITMDES_0' => ['type' => Type::string(), 'description' => ''],
            'BPSNUM_0' => ['type' => Type::string(), 'description' => ''],
            'QTYSTU_0' => ['type' => Type::string(), 'description' => ''],
            'ORDQTYPUU_0' => ['type' => Type::string(), 'description' => ''],
            'ORDQTYSTU_0' => ['type' => Type::string(), 'description' => ''],
            'PUU_0' => ['type' => Type::string(), 'description' => ''],
            'VACBPR_0' => ['type' => Type::string(), 'description' => ''],
            'CUR_0' => ['type' => Type::string(), 'description' => ''],

            'GROPRI_0' => ['type' => Type::string(), 'description' => ''],
            'NETPRI_0' => ['type' => Type::string(), 'description' => ''],
            'PRHFCY_0' => ['type' => Type::string(), 'description' => ''],
            'VAT_0' => ['type' => Type::string(), 'description' => ''],
            'CREUSR_0' => ['type' => Type::string(), 'description' => ''],
            'CREDATTIM_0' => ['type' => Type::string(), 'description' => ''],
            'etat' => ['type' => Type::int(), 'description' => ''],
            'etat_text' => ['type' => Type::string(), 'description' => ''],

            'article_id' => ['type' => Type::int(), 'description' => ''],
            'da_id' => ['type' => Type::int(), 'description' => ''],

        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDetailsda($args);
        return $query->get();
    }
}
