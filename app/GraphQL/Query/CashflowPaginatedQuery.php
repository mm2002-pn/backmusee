<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class CashflowPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'cashflowspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('cashflowspaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'week' => ['type' => Type::int(), 'description' => 'Numéro de semaine'],
            'date_debut' => ['type' => Type::string(), 'description' => 'Date de début de la période'],
            'date_fin' => ['type' => Type::string(), 'description' => 'Date de fin de la période'],
            'date' => ['type' => Type::string(), 'description' => ''],
            'datefin' => ['type' => Type::string(), 'description' => ''],
            'total_encaissements' => ['type' => Type::string(), 'description' => 'Total des encaissements'],
            'total_reglements' => ['type' => Type::string(), 'description' => 'Total des règlements'],
            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryCashflow($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
