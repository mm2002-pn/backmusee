<?php

namespace App\GraphQL\Type;


use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UserType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => ''
    ];

    public function fields(): array
    {
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'name' => ['type' => Type::string(), 'description' => ''],
                'email' => ['type' => Type::string(), 'description' => ''],
                'login' => ['type' => Type::string(), 'description' => ''],
                'password' => ['type' => Type::string(), 'description' => ''],
                'image' => ['type' => Type::string(), 'description' => ''],
                'role' => ['type' => GraphQL::type('Role'), 'description' => ''],
                'role_id' => ['type' => Type::int(), 'description' => ''],

                //code

                'code' => ['type' => Type::string(), 'description' => ''],
                'CATUSR_0' => ['type' => Type::string(), 'description' => ''],

                'profilable_id' => ['type' => Type::int(), 'description' => ''],
                'profilable_type' => ['type' => Type::string(), 'description' => ''],


                // compteclient
                'compteclient' => ['type' => Type::string(), 'description' => ''],

                'telephone' => ['type' => Type::string(), 'description' => ''],
                'ischantenne' => ['type' => Type::int(), 'description' => ''],
                'historiqueaffectations' => ['type' => Type::listOf(GraphQL::type('Historiqueaffectation')), 'description' => ''],
                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }
}
