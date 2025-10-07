<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Arr;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class PlanninghebdomadairePaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'planninghebdomadairespaginated',
        'description' => 'les plannings par page',
    ];

    public function type(): Type
    {
        return GraphQL::type("planninghebdomadairespaginated");
    }
    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::id()],
                'jour' => ['type' => Type::int()],
                'jour_id' => ['type' => Type::int()],
                'date_debut_semaine' => ['type' => Type::string()],
                'etat_text' => ['type' => Type::string()],
                'etat_badge' => ['type' => Type::string()],
                'user_id' => ['type' => Type::string()],
            ];
    }
    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryPlanninghebdomadaire($args);
        $count = Arr::get($args, 'count', 30);
        $page = Arr::get($args, 'page', 1);
        return $query->orderBy('id', 'desc')->paginate($count, ['*'], 'page', $page);
    }
}
