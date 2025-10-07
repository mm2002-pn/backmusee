<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class FournisseurPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'fournisseurspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('fournisseurspaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::int(), 'description' => ''],
            'email' => ['type' => Type::string(), 'description' => ''],
            'nom' => ['type' => Type::string(), 'description' => ''],
            'adresse' => ['type' => Type::string(), 'description' => ''],
            'score' => ['type' => Type::float(), 'description' => ''],

            'telephone' => ['type' => Type::string(), 'description' => ''],
            'typefournisseur_id' => ['type' => Type::int(), 'description' => ''],
            'TSSCOD_0_0_id' => ['type' => Type::int(), 'description' => ''],
            'TSSCOD_0_0' => ['type' => Type::int(), 'description' => ''],
            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryFournisseur($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
