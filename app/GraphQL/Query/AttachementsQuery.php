<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AttachementsQuery extends Query
{
    protected $attributes = [
        'name' => 'attachements',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Attachement'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'url' => ['type' => Type::string(), 'description' => ''],
            'date' => ['type' => Type::string(), 'description' => ''],
            'ao_id' => ['type' => Type::id(), 'description' => ''],
            'typeattachement_id' => ['type' => Type::id(), 'description' => ''],
            'documentspecification_id' => ['type' => Type::id(), 'description' => ''],
            'isannexe' => ['type' => Type::int(), 'description' => ''],


        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryAttachement($args);
        return $query->get();
    }
}
