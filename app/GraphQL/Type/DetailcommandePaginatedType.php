<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DetailcommandePaginatedType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'detailcommandespaginated',
        'description' => 'Liste paginée de Detailcommande',
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
                'type' => Type::listOf(GraphQL::type('Detailcommande')),
                'resolve' => function ($root) {
                    return $root;
                }
            ]
        ];
    }
}