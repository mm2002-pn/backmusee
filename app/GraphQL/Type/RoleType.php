<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;


class RoleType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Role',
        'description' => ''
    ];

    public function fields(): array
    {
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'name' => ['type' => Type::string(), 'description' => ''],
                'guard_name' => ['type' => Type::string(), 'description' => ''],
                'permissions' => ['type' => Type::listOf(GraphQL::type('Permission')), 'description' => ''],
                'iscommercial' => ['type' => Type::int(), 'description' => ''  ],
                'isplanning' => ['type' => Type::int(), 'description' => ''  ],
                'ischauffeur' => ['type' => Type::int(), 'description' => ''  ],
                'isadmin' => ['type' => Type::int(), 'description' => ''  ],
                'estautoriser' => ['type' => Type::int(), 'description' => ''  ],
                "auth_mobile" => ['type' => Type::int(), 'description' => ''],

                'ischantenne' => ['type' => Type::int(), 'description' => ''  ],

                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }
}
