<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class FichierfournisseurPaginatedType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'fichierfournisseurspaginated',
        'description' => 'Liste paginée de Dossierfournisseur',
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
                'type' => Type::listOf(GraphQL::type('Fichierfournisseur')),
                'resolve' => function ($root) {
                    return $root;
                }
            ]
        ];
    }
}