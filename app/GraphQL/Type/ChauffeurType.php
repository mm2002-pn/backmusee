<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ChauffeurType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Chauffeur',
        'description' => 'Type pour le modèle Chauffeur',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'email' => ['type' => Type::string(), 'description' => ''],
            'code' => ['type' => Type::string(), 'description' => ''],
            'nom' => ['type' => Type::string(), 'description' => ''],
            'adresse' => ['type' => Type::string(), 'description' => ''],
            'telephone' => ['type' => Type::string(), 'description' => ''],
            'estinterne' => ['type' => Type::int(), 'description' => ''],
            'vehicules' => ['type' => Type::listOf(GraphQL::type('Vehicule')), 'description' => ''],
        ];
    }
}
