<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class CommandePaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'commandespaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('commandespaginated');
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

            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryCommande($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
