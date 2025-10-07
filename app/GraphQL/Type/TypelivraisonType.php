<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TypelivraisonType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Typelivraison',
        'description' => 'Type pour le modèle Typelivraison',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'description' => ['type' => Type::string(), 'description' => ''],
        ];
    }
}