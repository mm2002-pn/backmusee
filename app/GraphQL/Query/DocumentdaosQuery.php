<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DocumentdaosQuery extends Query
{
    protected $attributes = [
        'name' => 'documentdaos'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Documentdao'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'designation' => ['type' => Type::string()],
                'document' => ['type' => Type::string()],
                'da_id' => ['type' => Type::int(), 'description' => ''],

                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],



            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDocumentdao($args);

        return $query->get();
    }
}
