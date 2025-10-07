<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class EquipegestionType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Equipegestion',
        'description' => 'Type pour le modèle Equipegestion',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'description' => ['type' => Type::string(), 'description' => ''],

            'personnels' => [
                'type' => Type::listOf(GraphQL::type('User')),
                'description' => 'Liste des personnels',
            ],
            'equipegestionpersonnels' => [
                'type' => Type::listOf(GraphQL::type('Equipegestionpersonnel')),
                'description' => 'Liste des relations entre équipe et personnel',
            ],
        ];
    }
}
