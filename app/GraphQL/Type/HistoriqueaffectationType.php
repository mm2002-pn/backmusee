<?php

namespace App\GraphQL\Type;


use App\Models\RefactoringItems\RefactGraphQLType;



use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class HistoriqueaffectationType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Historiqueaffectation',
        'description' => ''
    ];

    public function fields(): array
    {
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'date' => ['type' => Type::string(), 'description' => ''],
                'antenne_id' => ['type' => Type::int(), 'description' => ''],
                'user_id' => ['type' => Type::int(), 'description' => ''],

                'user' => ['type' => GraphQL::type('User'), 'description' => ''],
                'antenne' => ['type' => GraphQL::type('Antenne'), 'description' => ''],



                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }
}
