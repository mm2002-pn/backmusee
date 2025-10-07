<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class PlanningsQuery extends Query
{
    protected $attributes = [
        'name' => 'plannings',
        'description' => 'les plannings',
    ];
    public function type(): Type
    {
        return Type::listOf(GraphQL::type("Planning"));
    }
    public function args(): array
    {
        return
            [
            'id' => ['type' => Type::id()],
            'user_id' => ['type' =>Type::int()],
            'date' => ['type' => Type::string()],
            'voiture_id' => ['type' =>Type::int()],
            'datesemaine' => ['type' => Type::string()],
            'chauffeur_id' => ['type' =>Type::int()],
            'status' => ['type' => Type::int()],
            'commentaire' => ['type' => Type::string()],
            'address' => ['type' => Type::string()],
            'budget' => ['type' => Type::string()],
            'order'                                     => ['type' => Type::string()],
                'direction'                                 => ['type' => Type::string()],
        ];
    }
    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryPlanning($args);
        return $query->get();
    }
}
