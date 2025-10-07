<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class BailleurPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'bailleurspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('bailleurspaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'nom' => ['type' => Type::string(), 'description' => ''],
            'pays' => ['type' => Type::string(), 'description' => ''],
            'contact' => ['type' => Type::string(), 'description' => ''],
            'emailcontact' => ['type' => Type::string(), 'description' => ''],
            'telephone' => ['type' => Type::string(), 'description' => ''],
            'fax' => ['type' => Type::string(), 'description' => ''],
            'fixe' => ['type' => Type::string(), 'description' => ''],
            'user_id' => ['type' => Type::int(), 'description' => ''],
            'estactive' => ['type' => Type::int(), 'description' => ''],


            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryBailleur($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
