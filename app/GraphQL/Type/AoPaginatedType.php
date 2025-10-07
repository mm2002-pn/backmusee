<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AoPaginatedType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'aospaginated',
        'description' => 'Liste paginée de Ao',
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
                'type' => Type::listOf(GraphQL::type('Ao')),
                'resolve' => function ($root) {
                    return $root;
                }
            ]
        ];
    }
}