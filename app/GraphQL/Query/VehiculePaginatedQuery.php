<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class VehiculePaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'vehiculespaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('vehiculespaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'typevehicule_id' => ['type' => Type::id(), 'description' => ''],
            'matricule' => ['type' => Type::string(), 'description' => ''],
            'marque' => ['type' => Type::string(), 'description' => ''],
            'tonnage_id' => ['type' => Type::id(), 'description' => ''],
            'description' => ['type' => Type::string(), 'description' => ''],
            'volume' => ['type' => Type::float(), 'description' => ''],
            'estinterne' => ['type' => Type::int(), 'description' => ''],
            'chauffeur_id' => ['type' => Type::int(), 'description' => ''],


            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryVehicule($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
