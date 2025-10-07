<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CampagnePaginatedType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'campagnespaginated',
        'description' => 'Liste paginée de Campagne',
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
                'type' => Type::listOf(GraphQL::type('Campagne')),
                'resolve' => function ($root) {
                    return $root;
                }
            ]
        ];
    }
}