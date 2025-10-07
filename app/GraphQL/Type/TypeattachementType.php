<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TypeattachementType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Typeattachement',
        'description' => 'Type pour le modèle Typeattachement',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
        ];
    }
}
