<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DadocumentspecificationType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Dadocumentspecification',
        'description' => 'Type pour le modèle Dadocumentspecification',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'documentspecification_id' => ['type' => Type::id(), 'description' => ''],
            'da_id' => ['type' => Type::id(), 'description' => ''],
            'date' => ['type' => Type::string(), 'description' => ''],
            'isannexe' => ['type' => Type::int(), 'description' => ''],

            'documentspecification' => [
                'type' => GraphQL::type('Documentspecification'),
                'resolve' => function ($root) {
                    return $root->documentspecification;
                }
            ],
            'da' => [
                'type' => GraphQL::type('Da'),
                'resolve' => function ($root) {
                    return $root->da;
                }
            ],

            'url' => ['type' => Type::string(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],

        ];
    }
}
