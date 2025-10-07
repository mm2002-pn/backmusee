<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ClienttypeclientPaginatedType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'clienttypeclientspaginated',
        'description' => 'Liste paginée de Clienttypeclient',
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
                'type' => Type::listOf(GraphQL::type('Clienttypeclient')),
                'resolve' => function ($root) {
                    return $root;
                }
            ]
        ];
    }
}