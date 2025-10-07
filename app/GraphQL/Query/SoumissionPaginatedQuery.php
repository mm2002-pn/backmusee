<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class SoumissionPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'soumissionspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('soumissionspaginated');
    }

    public function args(): array
    {
        return [
            'id ' => ['type' => Type::id(), 'description' => ''],
            'date' => ['type' => Type::string(), 'description' => ''],
            'score' => ['type' => Type::float(), 'description' => ''],
            'statut' => ['type' => Type::int(), 'description' => ''],
            'isbc' => ['type' => Type::int(), 'description' => ''],
            'urlbc' => ['type' => Type::string(), 'description' => ''],
            'urlcontrat' => ['type' => Type::string(), 'description' => ''],
            'etatcontractel' => ['type' => Type::id(), 'description' => ''],
            'iscontrat' => ['type' => Type::int(), 'description' => ''],
            'ao_id' => ['type' => Type::id(), 'description' => ''],
            'fournisseur_id' => ['type' => Type::id(), 'description' => ''],
            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQuerySoumission($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
