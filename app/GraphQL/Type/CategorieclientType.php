<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CategorieclientType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Categorieclient',
        'description' => 'Type pour le modèle Categorieclient',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            // designation
            'designation' => ['type' => Type::string(), 'description' => ''],
            // description
            'description' => ['type' => Type::string(), 'description' => ''],
        ];
    }
}