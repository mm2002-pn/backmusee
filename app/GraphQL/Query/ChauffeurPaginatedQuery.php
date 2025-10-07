<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class ChauffeurPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'chauffeurspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('chauffeurspaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'email' => ['type' => Type::string(), 'description' => ''],
            'code' => ['type' => Type::string(), 'description' => ''],
            'nom' => ['type' => Type::string(), 'description' => ''],
            'adresse' => ['type' => Type::string(), 'description' => ''],
            'telephone' => ['type' => Type::string(), 'description' => ''],
            'estinterne' => ['type' => Type::int(), 'description' => ''],

            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryChauffeur($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
