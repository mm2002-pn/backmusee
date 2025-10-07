<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class RolesQuery extends Query
{
    protected $attributes = [
        'name' => 'roles'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Role'));
    }

    public function args(): array
    {
        return
            [
                'id'                    => ['type' => Type::int()],
                'iscommercial' => ['type' => Type::int(), 'description' => ''  ],
                'isplanning' => ['type' => Type::int(), 'description' => ''  ],
                'ischauffeur' => ['type' => Type::int(), 'description' => ''  ],
                'isadmin' => ['type' => Type::int(), 'description' => ''  ],
                'estautoriser' => ['type' => Type::int(), 'description' => ''  ],
                "auth_mobile" => ['type' => Type::int(), 'description' => ''],
                'ischantenne' => ['type' => Type::int(), 'description' => ''  ],

                'name'                  => ['type' => Type::string()],
                'connected_user'        => ['type' => Type::int()],

            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryRole($args);

        return $query->get();

    }
}
