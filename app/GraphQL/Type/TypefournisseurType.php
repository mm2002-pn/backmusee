<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TypefournisseurType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Typefournisseur',
        'description' => 'Type pour le modèle Typefournisseur',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            // Ajouter d'autres champs ici
            'designation' => ['type' => Type::string(), 'description' => ''],
        ];
    }
}
