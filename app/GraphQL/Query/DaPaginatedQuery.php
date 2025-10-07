<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class DaPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'daspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('daspaginated');
    }

    public function args(): array
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
            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDa($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
