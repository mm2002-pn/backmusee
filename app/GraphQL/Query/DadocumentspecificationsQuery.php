<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DadocumentspecificationsQuery extends Query
{
    protected $attributes = [
        'name' => 'dadocumentspecifications',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Dadocumentspecification'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'documentspecification_id' => ['type' => Type::id(), 'description' => ''],
            'isannexe' => ['type' => Type::int(), 'description' => ''],
            'da_id' => ['type' => Type::id(), 'description' => ''],
            'date' => ['type' => Type::string(), 'description' => ''],
            'url' => ['type' => Type::string(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],

        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDadocumentspecification($args);
        return $query->get();
    }
}
