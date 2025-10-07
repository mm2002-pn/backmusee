<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CampagnesQuery extends Query
{
    protected $attributes = [
        'name' => 'campagnes',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Campagne'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'date'  => ['type' => Type::string(), 'description' => ''],
            'datefin'  => ['type' => Type::string(), 'description' => ''],

            'designation'  => ['type' => Type::string(), 'description' => ''],
            'programme_id'  => ['type' => Type::id(), 'description' => ''],
            'image'  => ['type' => Type::string(), 'description' => ''],

            'statut'  => ['type' => Type::string(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryCampagne($args);
        return $query->get();
    }
}
