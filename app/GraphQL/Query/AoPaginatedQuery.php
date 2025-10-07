<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class AoPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'aospaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('aospaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id()],
            'date' => ["type" => Type::string(), 'descrition' => ''],
            'reference' => ["type" => Type::string(), 'descrition' => ''],
            'typemarche_id' => ["type" => Type::string(), 'descrition' => ''],
            'typeprocedure_id' => ["type" => Type::string(), 'descrition' => ''],
            'datepublication' => ["type" => Type::string(), 'descrition' => ''],
            'designation' => ["type" => Type::string(), 'descrition' => ''],

            'statut' => ["type" => Type::string(), 'descrition' => ''],
            'isnotationfournisseur' => ['type' => Type::int(), 'description' => ''],
            'urlnotationfournisseur' => ['type' => Type::string(), 'description' => ''],

            'isnotationarticle' => ['type' => Type::int(), 'description' => ''],
            'urlnotationarticle' => ['type' => Type::string(), 'description' => ''],

            'isnotationadministrative' => ['type' => Type::int(), 'description' => ''],
            'urlnotationadministrative' => ['type' => Type::string(), 'description' => ''],
            'fournisseur_id' => ["type" => Type::int(), 'descrition' => ''],
            'soumission' => ["type" => Type::int(), 'descrition' => ''],



            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryAo($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
