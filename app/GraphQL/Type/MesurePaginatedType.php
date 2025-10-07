<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class MesurePaginatedType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'mesurespaginated',
        'description' => 'Liste paginée de Mesure',
    ];

    public function fields(): array
    {
        return [

            'metadata' => [
                'type' => GraphQL::type('Metadata'),
                'resolve' => function ($root) {
                    return array_except($root->toArray(), ['data']);
                }
            ],

            'data' => [
                'type' => Type::listOf(GraphQL::type('Mesure')),
                'resolve' => function ($root) {
                    return $root;
                }
            ]
        ];
    }
}