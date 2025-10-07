<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class NoteevaluationType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Noteevaluation',
        'description' => 'Type pour le modèle Noteevaluation',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'fichecritere_id' => ['type' => Type::int(), 'description' => 'ID de la fiche critère associée'],
            'evaluationsfournisseur_id' => ['type' => Type::int(), 'description' => 'ID de l\'évaluation fournisseur associée'],
            'note' => ['type' => Type::float(), 'description' => 'Note
    attribuée'],
            'created_at' => ['type' => Type::string(), 'description' => 'Date de création'],
            'updated_at' => ['type' => Type::string(), 'description' => 'Date de mise à jour'],
            // relations
            'fichecritere' => ['type' => GraphQL::type('Fichecritere'), 'description' => ''],
            'evaluationsfournisseur' => ['type' => GraphQL::type('Evaluationsfournisseur'), 'description' => ''],
        ];
    }
}
