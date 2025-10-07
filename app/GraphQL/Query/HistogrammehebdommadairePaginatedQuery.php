<?php

namespace App\GraphQL\Query;


use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;


class HistogrammehebdommadairePaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'histogrammehebdommadairespaginated'
    ];

    public function type(): Type
    {
        return GraphQL::type('histogrammehebdommadairespaginated');
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'nombre' => ['type' => Type::int(), 'description' => ''],

                'date' => ['type' => Type::string(), 'description' => ''],
                'datefin' => ['type' => Type::string(), 'description' => ''],

                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        // Récupérer la requête
        $query = QueryModel::getQueryHistogrammehebdommadaire($root,$args);

        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);

        // Appliquer la pagination
        $paginated = $query->paginate($count, ['*'], 'page', $page);

        $paginated->setCollection(
            $paginated->getCollection()->map(function ($item) use ($args) {
                $item->args = $args;
                return $item;
            })
        );

        return $paginated;
    }
}
