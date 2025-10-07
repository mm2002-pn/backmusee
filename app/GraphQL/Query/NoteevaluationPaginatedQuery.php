<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;

class NoteevaluationPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'noteevaluationspaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('noteevaluationspaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'fichecritere_id' => ['type' => Type::int(), 'description' => 'ID de la fiche critère associée'],
            'note' => ['type' => Type::float(), 'description' => 'Note
    attribuée'],
            'evaluationsfournisseur_id' => ['type' => Type::int(), 'description' => 'ID de l\'évaluation fournisseur associée'],

            'created_at' => ['type' => Type::string(), 'description' => 'Date de création'],
            'updated_at' => ['type' => Type::string(), 'description' => 'Date de mise à jour'],
            'page' => ['type' => Type::int()],
            'count' => ['type' => Type::int()],
            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryNoteevaluation($args);
        $count = Arr::get($args, 'count', 20);
        $page = Arr::get($args, 'page', 1);
        return $query->paginate($count, ['*'], 'page', $page);
    }
}
