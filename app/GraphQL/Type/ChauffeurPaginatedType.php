<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ChauffeurPaginatedType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'chauffeurspaginated',
        'description' => 'Liste paginée de Chauffeur',
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
                'type' => Type::listOf(GraphQL::type('Chauffeur')),
                'resolve' => function ($root) {
                    return $root;
                }
            ]
        ];
    }
}