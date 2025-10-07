<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class CampagnePaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'campagnespaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('campagnespaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            // Ajouter d'autres champs ici
            'date'  => ['type' => Type::string(), 'description' => ''],
            'datefin'  => ['type' => Type::string(), 'description' => ''],

            'designation'  => ['type' => Type::string(), 'description' => ''],
            'statut'  => ['type' => Type::string(), 'description' => ''],
            'page' => ['type' => Type::int()],
            'programme_id'  => ['type' => Type::id(), 'description' => ''],
            'image'  => ['type' => Type::string(), 'description' => ''],

            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryCampagne($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
