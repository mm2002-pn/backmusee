<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class FichecriteresQuery extends Query
{
    protected $attributes = [
        'name' => 'fichecriteres',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Fichecritere'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'ficheevaluation_id' => ['type' => Type::int(), 'description' => ''],
            'critere_id' => ['type' => Type::int(), 'description' => ''],
            'ponderation' => ['type' => Type::float(), 'description' => ''],
            'ordre' => ['type' => Type::int(), 'description' => ''],
            'created_at' => ['type' => Type::string(), 'description' => ''],
            'updated_at' => ['type' => Type::string(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryFichecritere($args);
        return $query->get();
    }
}
