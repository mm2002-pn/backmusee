<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TypeprocedureType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Typeprocedure',
        'description' => 'Type pour le modèle Typeprocedure',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
        ];
    }
}