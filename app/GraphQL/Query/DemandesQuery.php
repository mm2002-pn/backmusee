<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DemandesQuery extends Query
{
    protected $attributes = [
        'name' => 'demandes'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Demande'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'commercial_id' => ['type' => Type::int(), 'description' => ''],
                'pointdevente_id' => ['type' => Type::int(), 'description' => ''],
                'date' => ['type' => Type::string(), 'description' => ''],
                'etat' => ['type' => Type::int(), 'description' => ''],
                'etat_text' => ['type' => Type::string()],
                'etat_badge'=> ['type' => Type::string()],


               

                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],



            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDemande($args);

        return $query->get();
    }
}
