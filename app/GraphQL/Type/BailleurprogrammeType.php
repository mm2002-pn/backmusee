<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class BailleurprogrammeType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Bailleurprogramme',
        'description' => 'Type pour le modèle Bailleurprogramme',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'bailleur_id' => ['type' => Type::id(), 'description' => ''],
            'programme_id' => ['type' => Type::id(), 'description' => ''],
            'programme' => ['type' => GraphQL::type('Programme'), 'description' => ''],
            'bailleur' => ['type' => GraphQL::type('Bailleur'), 'description' => ''],
        ];
    }
}