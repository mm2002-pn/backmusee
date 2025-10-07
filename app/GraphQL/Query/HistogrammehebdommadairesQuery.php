<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class HistogrammehebdommadairesQuery extends Query
{
    protected $attributes = [
        'name' => 'histogrammehebdommadaires'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Histogrammehebdommadaire'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'nombre' => ['type' => Type::int(), 'description' => ''],

                'date' => ['type' => Type::string(), 'description' => ''],
                'datefin' => ['type' => Type::string(), 'description' => ''],


                'est_activer' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryHistogrammehebdommadaire($root, $args);
        
      

        return $query->get()->map(function ($item) use ($args) {
            $item->args = $args; // Ajoutez les arguments ici
            return $item;
        });
    }
}
