<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class RolePaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'rolespaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('rolespaginated');
    }

    public function args(): array
    {
        return
            [
                'id'                    => ['type' => Type::int()],
                'page'                  => ['type' => Type::int()],
                'iscommercial' => ['type' => Type::int(), 'description' => ''  ],
                'isplanning' => ['type' => Type::int(), 'description' => ''  ],
                'ischauffeur' => ['type' => Type::int(), 'description' => ''  ],
                'isadmin' => ['type' => Type::int(), 'description' => ''  ],
                'estautoriser' => ['type' => Type::int(), 'description' => ''  ],
                "auth_mobile" => ['type' => Type::int(), 'description' => ''],
                'ischantenne' => ['type' => Type::int(), 'description' => ''  ],


                'count'                 => ['type' => Type::int()],
                'name'                  => ['type' => Type::string()],
                'connected_user'        => ['type' => Type::int()],



            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryRole($args);

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->paginate($count, ['*'], 'page', $page);

    }


}
