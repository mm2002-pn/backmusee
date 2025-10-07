<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ParcourmarchePaginatedType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'parcourmarchespaginated',
        'description' => 'Liste paginée de parcours',
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
                'type' => Type::listOf(GraphQL::type('Parcourmarche')),
                'resolve' => function ($root) {
                    return $root;
                }
            ]
        ];
    }
}
