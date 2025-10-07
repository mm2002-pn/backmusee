<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class AttachementPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'attachementspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('attachementspaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'url' => ['type' => Type::string(), 'description' => ''],
            'date' => ['type' => Type::string(), 'description' => ''],
            'ao_id' => ['type' => Type::id(), 'description' => ''],
            'typeattachement_id' => ['type' => Type::id(), 'description' => ''],
            'documentspecification_id' => ['type' => Type::id(), 'description' => ''],
            'isannexe' => ['type' => Type::int(), 'description' => ''],



            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryAttachement($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
