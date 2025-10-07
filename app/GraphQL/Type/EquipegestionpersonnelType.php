<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class EquipegestionpersonnelType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Equipegestionpersonnel',
        'description' => 'Type pour le modèle Equipegestionpersonnel',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'equipegestion_id' => ['type' => Type::int(), 'description' => ''],
            'personnel_id' => ['type' => Type::int(), 'description' => ''],
            'date' => ['type' => Type::string(), 'description' => ''],
            'datefin' => ['type' => Type::string(), 'description' => ''],

            'equipegestion' => ['type' => GraphQL::type('Equipegestion'), 'description' => ''],
            'personnel' => ['type' => GraphQL::type('User'), 'description' => ''],

        ];
    }
}
