<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class EquipegestionpersonnelsQuery extends Query
{
    protected $attributes = [
        'name' => 'equipegestionpersonnels',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Equipegestionpersonnel'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'equipegestion_id' => ['type' => Type::int(), 'description' => ''],
            'personnel_id' => ['type' => Type::int(), 'description' => ''],
            
            'date' => ['type' => Type::string(), 'description' => ''],
            'datefin' => ['type' => Type::string(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryEquipegestionpersonnel($args);
        return $query->get();
    }
}
