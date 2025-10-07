<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class PersonnelPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'personnelspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('personnelspaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'nom' => ['type' => Type::string(), 'description' => ''],
            'prenom' => ['type' => Type::string(), 'description' => ''],
            'poste' => ['type' => Type::string(), 'description' => ''],
            'telephone' => ['type' => Type::string(), 'description' => ''],
            'user_id' => ['type' => Type::int(), 'description' => ''],

            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryPersonnel($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
