<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DasQuery extends Query
{
    protected $attributes = [
        'name' => 'das',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Da'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'PSHNUM_0' => ['type' => Type::string(), 'description' => ''],
            'CPY_0' => ['type' => Type::string(), 'description' => ''],
            'PSHFCY_0' => ['type' => Type::string(), 'description' => ''],
            'PRQDAT_0' => ['type' => Type::string(), 'description' => ''],
            'USR_0' => ['type' => Type::string(), 'description' => ''],
            'REQUSR_0' => ['type' => Type::string(), 'description' => ''],
            'CREUSR_0' => ['type' => Type::string(), 'description' => ''],
            'CREDATTIM_0' => ['type' => Type::string(), 'description' => ''],
            'date' => ['type' => Type::string(), 'description' => ''],
            'YTYPEPASS_0' => ['type' => Type::int(), 'description' => ''],
            'YCOM_0' => ['type' => Type::string(), 'description' => ''],
            'YSERVICE_0' => ['type' => Type::string(), 'description' => ''],
            'typemarche_id' => ['type' => Type::int(), 'description' => ''],
            'user_id' => ['type' => Type::int(), 'description' => ''],
            'responsable_id' => ['type' => Type::int(), 'description' => ''],

        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDa($args);
        return $query->get();
    }
}
