<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class PrequalificationPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'prequalificationspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('prequalificationspaginated');
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
            'adresse' => ['type' => Type::string(), 'description' => ''],
            'fabricant_id'  => ['type' => Type::int(), 'description' => ''],
            'article_id'  => ['type' => Type::int(), 'description' => ''],


            // pays_id
            'pays_id' => ['type' => Type::int(), 'description' => ''],
            'fabriquant' => ['type' => Type::string(), 'description' => ''],

            // dateprequalification
            'dateprequalification' => ['type' => Type::string(), 'description' => ''],
            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryPrequalification($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
