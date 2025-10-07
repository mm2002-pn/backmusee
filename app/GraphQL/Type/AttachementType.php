<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AttachementType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Attachement',
        'description' => 'Type pour le modèle Attachement',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'url' => ['type' => Type::string(), 'description' => ''],
            'date' => ['type' => Type::string(), 'description' => ''],
            'ao_id' => ['type' => Type::id(), 'description' => ''],
            'typeattachement_id' => ['type' => Type::id(), 'description' => ''],
            
            'typeattachement' => ['type' => GraphQL::type('Typeattachement'), 'description' => ''],
            'ao' => ['type' => GraphQL::type('Ao'), 'description' => ''],

            'documentspecification' => ['type' => GraphQL::type('Documentspecification'), 'description' => ''],
            'documentspecification_id' => ['type' => Type::id(), 'description' => ''],
            'isannexe' => ['type' => Type::int(), 'description' => ''],
        ];
    }
}
