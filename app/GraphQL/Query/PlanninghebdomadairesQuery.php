<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class PlanninghebdomadairesQuery extends Query
{
    protected $attributes = [
        'name' => 'planninghebdomadaires',
        'description' => 'les plannings',
    ];
    public function type(): Type
    {
        return Type::listOf(GraphQL::type("Planninghebdomadaire"));
    }
    public function args(): array
    {
        return
            [
            'id' => ['type' => Type::id()],
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
        return $query->get();
    }
}
