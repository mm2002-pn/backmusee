<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AosQuery extends Query
{
    protected $attributes = [
        'name' => 'aos',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Ao'));
    }


    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'date' => ["type" => Type::string(), 'descrition' => ''],
            'designation' => ["type" => Type::string(), 'descrition' => ''],
            'statut' => ["type" => Type::string(), 'descrition' => ''],
            'reference' => ["type" => Type::string(), 'descrition' => ''],
            'typemarche_id' => ["type" => Type::string(), 'descrition' => ''],
            'typeprocedure_id' => ["type" => Type::string(), 'descrition' => ''],
            'datepublication' => ["type" => Type::string(), 'descrition' => ''],
            'isnotationfournisseur' => ['type' => Type::int(), 'description' => ''],
            'urlnotationfournisseur' => ['type' => Type::string(), 'description' => ''],

            'isnotationarticle' => ['type' => Type::int(), 'description' => ''],
            'urlnotationarticle' => ['type' => Type::string(), 'description' => ''],
            'fournisseur_id' => ["type" => Type::int(), 'descrition' => ''],
            'soumission' => ["type" => Type::int(), 'descrition' => ''],


            'isnotationadministrative' => ['type' => Type::int(), 'description' => ''],
            'urlnotationadministrative' => ['type' => Type::string(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryAo($args);
        return $query->get();
    }
}
