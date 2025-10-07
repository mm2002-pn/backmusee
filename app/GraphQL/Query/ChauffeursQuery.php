<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ChauffeursQuery extends Query
{
    protected $attributes = [
        'name' => 'chauffeurs',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Chauffeur'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'email' => ['type' => Type::string(), 'description' => ''],
            'code' => ['type' => Type::string(), 'description' => ''],
            'nom' => ['type' => Type::string(), 'description' => ''],
            'adresse' => ['type' => Type::string(), 'description' => ''],
            'telephone' => ['type' => Type::string(), 'description' => ''],
            'estinterne' => ['type' => Type::int(), 'description' => ''],

        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryChauffeur($args);
        return $query->get();
    }
}
