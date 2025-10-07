<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class DetailsdaPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'detailsdaspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('detailsdaspaginated');
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

            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDetailsda($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
