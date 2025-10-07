<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DocumentspecificationPaginatedType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'documentspecificationspaginated',
        'description' => 'Liste paginée de Documentspecification',
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
                'type' => Type::listOf(GraphQL::type('Documentspecification')),
                'resolve' => function ($root) {
                    return $root;
                }
            ]
        ];
    }
}