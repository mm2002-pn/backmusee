<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CommandesQuery extends Query
{
    protected $attributes = [
        'name' => 'commandes',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Commande'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'datecommande' => ['type' => Type::string(), 'description' => ''],
            'datereception' => ['type' => Type::string(), 'description' => ''],
            'statut' => ['type' => Type::int(), 'description' => ''],
            'client_id' => ['type' => Type::int(), 'description' => ''],
            'typelivraison_id' => ['type' => Type::int(), 'description' => ''],
            'campagne_id' => ['type' => Type::int(), 'description' => ''],
            'bailleur_id' => ['type' => Type::int(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryCommande($args);
        return $query->get();
    }
}
