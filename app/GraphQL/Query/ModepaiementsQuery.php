<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ModepaiementsQuery extends Query
{
    protected $attributes = [
        'name' => 'modepaiements'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Modepaiement'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'designation' => ['type' => Type::string()],
                'desc' => ['type' => Type::string()],
                'image' => ['type' => Type::string(), 'description' => ''],
                'code' => ['type' => Type::string(), 'description' => ''],
                // imgurl
                'imgurl' => ['type' => Type::string(), 'description' => ''],
                'modepaiement_id' => ['type' => Type::int(), 'description' => ''],

                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],



            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryModepaiement($args);

        return $query->get();
    }
}
