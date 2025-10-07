<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class PrequalificationsQuery extends Query
{
    protected $attributes = [
        'name' => 'prequalifications',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Prequalification'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            //anneeprequalification
            'anneeprequalification' => ['type' => Type::int(), 'description' => ''],
            //anneeexpiration
            'anneeexpiration' => ['type' => Type::int(), 'description' => ''],
            //referenceaoip
            'referenceaoip' => ['type' => Type::string(), 'description' => ''],
            //code
            'code' => ['type' => Type::string(), 'description' => ''],
            //type
            'type' => ['type' => Type::string(), 'description' => ''],
            //denomination
            'denomination' => ['type' => Type::string(), 'description' => ''],
            //cdt
            'cdt' => ['type' => Type::string(), 'description' => ''],
            //statut
            'statut' => ['type' => Type::int(), 'description' => ''],
            // fournisseur_id
            'fournisseur_id' => ['type' => Type::int(), 'description' => ''],
            // adresse
            'adresse' => ['type' => Type::int(), 'description' => ''],

            'fabriquant_id'  => ['type' => Type::int(), 'description' => ''],

            'article_id'  => ['type' => Type::int(), 'description' => ''],

            // fabriquant
            'fabriquant' => ['type' => Type::string(), 'description' => ''],

            // pays_id
            'pays_id' => ['type' => Type::int(), 'description' => ''],

            // dateprequalification
            'dateprequalification' => ['type' => Type::string(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryPrequalification($args);
        return $query->get();
    }
}
