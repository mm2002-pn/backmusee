<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DetailsdaPaginatedType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'detailsdaspaginated',
        'description' => 'Liste paginée de Article',
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
                'type' => Type::listOf(GraphQL::type('Detailsda')),
                'resolve' => function ($root) {
                    return $root;
                }
            ]
        ];
    }
}
