<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class RemisedureedeviePaginatedType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'remisedureedeviespaginated',
        'description' => 'Liste paginée de Remisedureedevie',
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
                'type' => Type::listOf(GraphQL::type('Remisedureedevie')),
                'resolve' => function ($root) {
                    return $root;
                }
            ]
        ];
    }
}