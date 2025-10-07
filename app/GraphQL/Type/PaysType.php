<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class PaysType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Pays',
        'description' => 'Type pour le modèle Pays',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::int(), 'description' => ''],
            // Ajouter d'autres champs ici
            'designation' => ['type' => Type::string(), 'description' => ''],
        ];
    }
}