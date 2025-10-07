<?php

namespace App\GraphQL\Type;


use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UserzoneType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Userzone',
        'description' => ''
    ];

    public function fields(): array
    {
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
            
               
                'user' => ['type' => GraphQL::type('User'), 'description' => ''],
                
                //code


                'zone' => ['type' => GraphQL::type('Zone'), 'description' => ''],
                'zone_id' => ['type' => Type::int(), 'description' => ''],

                'user_id' => ['type' => Type::int(), 'description' => ''],
                'date' => ['type' => Type::string(), 'description' => ''],

                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }
}
