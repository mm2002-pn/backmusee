<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class FichecritereType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Fichecritere',
        'description' => 'Type pour le modèle Fichecritere',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'ficheevaluation_id' => ['type' => Type::int(), 'description' => ''],
            'critere_id' => ['type' => Type::int(), 'description' => ''],
            'ponderation' => ['type' => Type::float(), 'description' => ''],
            'ordre' => ['type' => Type::int(), 'description' => ''],
            'created_at' => ['type' => Type::string(), 'description' => ''],
            'updated_at' => ['type' => Type::string(), 'description' => ''],
            // Relations
            'ficheevaluation' => [
                'type' => GraphQL::type('Ficheevaluation'),
                'description' => 'La fiche d\'évaluation associée',
            ],
            'critere' => [
                'type' => GraphQL::type('Critere'), 
                'description' => 'Le critère associé',
            ],
        ];
    }
}