<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class PersonnelPaginatedType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'personnelspaginated',
        'description' => 'Liste paginée de Personnel',
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
                'type' => Type::listOf(GraphQL::type('Personnel')),
                'resolve' => function ($root) {
                    return $root;
                }
            ]
        ];
    }
}