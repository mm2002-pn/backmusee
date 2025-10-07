<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class TypemarchedetailPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'typemarchedetailspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('typemarchedetailspaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'position' => ['type' => Type::string(), 'description' => ''],
            'description' => ['type' => Type::string(), 'description' => ''],
            'typemarche_id' => ['type' => Type::int(), 'description' => ''],
            'parcourmarche_id' => ['type' => Type::int(), 'description' => ''],
            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryTypemarchedetail($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
