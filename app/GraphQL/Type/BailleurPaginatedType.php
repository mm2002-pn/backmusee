<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class BailleurPaginatedType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'bailleurspaginated',
        'description' => 'Liste paginée de Bailleur',
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
                'type' => Type::listOf(GraphQL::type('Bailleur')),
                'resolve' => function ($root) {
                    return $root;
                }
            ]
        ];
    }
}