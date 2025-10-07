<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class MesureType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Mesure',
        'description' => 'Type pour le modèle Mesure',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::int(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => 'Désignation de la mesure'],
            'description' => ['type' => Type::string(), 'description' => 'Description de la mesure'],
        ];
    }
}
