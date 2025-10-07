<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Arr;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class PlanningPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'planningspaginated',
        'description' => 'les plannings par page',
    ];

    public function type(): Type
    {
        return GraphQL::type("planningspaginated");
    }
    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::id()],
                'user_id' => ['type' => Type::int()],
                'voiture_id' => ['type' =>Type::int()],
                'chauffeur_id' => ['type' =>Type::int()],
                'date' => ['type' => Type::string()],
                'datesemaine' => ['type' => Type::string()],
                'status' => ['type' => Type::int()],
                'commentaire' => ['type' => Type::string()],
                'address' => ['type' => Type::string()],
                'budget' => ['type' => Type::string()],
                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order' => ['type' => Type::string()],
                'direction' => ['type' => Type::string()],
        ];
    }
    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryPlanning($args);
        $count = Arr::get($args, 'count', 30);
        $page = Arr::get($args, 'page', 1);
        return $query->orderBy('id', 'desc')->paginate($count, ['*'], 'page', $page);

    }
}
