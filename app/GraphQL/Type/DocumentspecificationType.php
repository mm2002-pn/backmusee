<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DocumentspecificationType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Documentspecification',
        'description' => 'Type pour le modèle Documentspecification',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'etape' => ['type' => Type::int(), 'description' => ''],
            'etatetexte' => ['type' => Type::string(), 'description' => ''],
            'section' => ['type' => Type::int(), 'description' => ''],
            'sectiontexte' => ['type' => Type::string(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'nature' => ['type' => Type::string(), 'description' => ''],
            'typemarche_id' => ['type' => Type::int(), 'description' => ''],
            'typemarche' => ['type' => GraphQL::type('Typemarche'), 'description' => ''],
        ];
    }
}
