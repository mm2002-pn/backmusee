<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AttachementPaginatedType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'attachementspaginated',
        'description' => 'Liste paginée de Attachement',
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
                'type' => Type::listOf(GraphQL::type('Attachement')),
                'resolve' => function ($root) {
                    return $root;
                }
            ]
        ];
    }
}