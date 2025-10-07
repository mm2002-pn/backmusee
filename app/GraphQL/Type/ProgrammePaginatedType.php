<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ProgrammePaginatedType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'programmespaginated',
        'description' => 'Liste paginée de Programme',
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
                'type' => Type::listOf(GraphQL::type('Programme')),
                'resolve' => function ($root) {
                    return $root;
                }
            ]
        ];
    }
}