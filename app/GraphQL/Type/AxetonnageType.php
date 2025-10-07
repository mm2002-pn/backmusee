<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AxetonnageType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Axetonnage',
        'description' => 'Type pour le modèle Axetonnage',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'axe_id' => ['type' => Type::int(), 'description' => ''],
            'tonnage_id' => ['type' => Type::int(), 'description' => ''],
            'axe' => ['type' => GraphQL::type('Axe'), 'description' => ''],
            'tonnage' => ['type' => GraphQL::type('Tonnage'), 'description' => ''],
        ];
    }
}