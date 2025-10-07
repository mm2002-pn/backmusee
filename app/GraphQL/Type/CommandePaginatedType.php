<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CommandePaginatedType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'commandespaginated',
        'description' => 'Liste paginée de Commande',
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
                'type' => Type::listOf(GraphQL::type('Commande')),
                'resolve' => function ($root) {
                    return $root;
                }
            ]
        ];
    }
}