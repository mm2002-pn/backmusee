<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class VehiculesQuery extends Query
{
    protected $attributes = [
        'name' => 'vehicules',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Vehicule'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'typevehicule_id' => ['type' => Type::id(), 'description' => ''],
            'matricule' => ['type' => Type::string(), 'description' => ''],
            'marque' => ['type' => Type::string(), 'description' => ''],
            'tonnage_id' => ['type' => Type::id(), 'description' => ''],
            'description' => ['type' => Type::string(), 'description' => ''],
            'volume' => ['type' => Type::float(), 'description' => ''],
            'estinterne' => ['type' => Type::int(), 'description' => ''],
            'chauffeur_id' => ['type' => Type::int(), 'description' => ''],


        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryVehicule($args);
        return $query->get();
    }
}
