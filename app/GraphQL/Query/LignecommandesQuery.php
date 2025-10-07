<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class LignecommandesQuery extends Query
{
    protected $attributes = [
        'name' => 'lignecommandes',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Lignecommande'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'produit_id' => ['type' => Type::int(), 'description' => ''],
            'quantite' => ['type' => Type::int(), 'description' => ''],
            'prix' => ['type' => Type::int(), 'description' => ''],
            'avg' => ['type' => Type::int(), 'description' => ''],
            'programme_id' => ['type' => Type::int(), 'description' => ''],
            'campagne_id' => ['type' => Type::int(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryLignecommande($args);
        return $query->get();
    }
}
