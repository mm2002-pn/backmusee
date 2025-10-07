<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TonnageType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Tonnage',
        'description' => 'Type pour le modèle Tonnage',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'tonnage' => ['type' => Type::float(), 'description' => ''],
            'unite_id' => ['type' => Type::int(), 'description' => ''],
            'unite' => ['type' => GraphQL::type('Unite'), 'description' => ''],
            'min' => ['type' => Type::float(), 'description' => ''],
            'max' => ['type' => Type::float(), 'description' => ''],
            'created_at' => ['type' => Type::string(), 'description' => ''],
            'updated_at' => ['type' => Type::string(), 'description' => ''],
        ];
    }
}
