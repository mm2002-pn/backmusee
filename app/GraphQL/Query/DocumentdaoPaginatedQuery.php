<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class DocumentdaoPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'documentdaospaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('documentdaospaginated');
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'designation' => ['type' => Type::string()],
                'document' => ['type' => Type::string()],
                'da_id' => ['type' => Type::int(), 'description' => ''],
                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],

                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDocumentdao($args);

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        return $query->paginate($count, ['*'], 'page', $page);
    }
}
