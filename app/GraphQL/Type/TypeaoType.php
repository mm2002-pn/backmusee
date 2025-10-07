<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TypeaoType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Typeao',
        'description' => 'Type pour le modèle Typeao',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation'   => ['type' => Type::string(), 'description' => ''],
        ];
    }
}