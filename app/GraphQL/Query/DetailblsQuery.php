<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DetailblsQuery extends Query
{
    protected $attributes = [
        'name' => 'detailbls',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Detailbl'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
               'bl_id' => ['type' => Type::int(), 'description' => ''],
                'date' => ['type' => Type::string(), 'description' => ''],
                'produit_id' => ['type' => Type::int(), 'description' => ''],
                'commercial_id' => ['type' => Type::int(), 'description' => ''],
                'pointdevente_id' => ['type' => Type::int(), 'description' => ''],
                'quantite' => ['type' => Type::string(), 'description' => ''],

 
                'est_activer' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],



            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDetailbl($root,$args);

        return $query->get();
    }
}
