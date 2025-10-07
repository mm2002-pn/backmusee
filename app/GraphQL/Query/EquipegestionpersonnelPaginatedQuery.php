<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class EquipegestionpersonnelPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'equipegestionpersonnelspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('equipegestionpersonnelspaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'equipegestion_id' => ['type' => Type::int(), 'description' => ''],
            'personnel_id' => ['type' => Type::int(), 'description' => ''],
            'date' => ['type' => Type::string(), 'description' => ''],
            'fabriquant_id'  => ['type' => Type::int(), 'description' => ''],

            'datefin' => ['type' => Type::string(), 'description' => ''],
            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryEquipegestionpersonnel($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
