<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ParkingsQuery extends Query
{
    protected $attributes = [
        'name' => 'parkings',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Parking'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'fournisseur_id' => ['type' => Type::int(), 'description' => ''],
            'vehicule_id' => ['type' => Type::int(), 'description' => ''],


        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryParking($args);
        return $query->get();
    }
}
