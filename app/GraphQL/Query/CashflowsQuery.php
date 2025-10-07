<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CashflowsQuery extends Query
{
    protected $attributes = [
        'name' => 'cashflows',
        'description' => 'Query pour récupérer les cashflows',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Cashflow'));
    }

    public function args(): array
    {
        return [
            'week' => ['type' => Type::int(), 'description' => 'Filtrer par numéro de semaine'],
            'date_debut' => ['type' => Type::string(), 'description' => 'Filtrer par date de début'],
            'date_fin' => ['type' => Type::string(), 'description' => 'Filtrer par date de fin'],

            'date' => ['type' => Type::string(), 'description' => ''],
            'datefin' => ['type' => Type::string(), 'description' => ''],
            'min_total_encaissements' => ['type' => Type::string(), 'description' => 'Filtrer par montant minimum d\'encaissements'],
            'min_total_reglements' => ['type' => Type::string(), 'description' => 'Filtrer par montant minimum de règlements'],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryCashflow($args);
        return $query->get();
    }
}
