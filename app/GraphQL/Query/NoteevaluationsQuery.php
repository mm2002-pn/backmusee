<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class NoteevaluationsQuery extends Query
{
    protected $attributes = [
        'name' => 'noteevaluations',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Noteevaluation'));
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
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryNoteevaluation($args);
        return $query->get();
    }
}
