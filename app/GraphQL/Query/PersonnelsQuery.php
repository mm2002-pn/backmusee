<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class PersonnelsQuery extends Query
{
    protected $attributes = [
        'name' => 'personnels',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Personnel'));
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

        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryPersonnel($args);
        return $query->get();
    }
}
