<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class EquipementsQuery extends Query
{
    protected $attributes = [
        'name' => 'equipements'
    ];

    public function type(): Type
    {
       return Type::listOf(GraphQL::type('Equipement'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'designation' => ['type' => Type::string(), 'description' => ''],
                'description' => ['type' => Type::string(), 'description' => ''],
                'image' => ['type' => Type::string(), 'description' => ''],
                
                'est_activer' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryEquipement($args);

        return $query->get();
    }
}
