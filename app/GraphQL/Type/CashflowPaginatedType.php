<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CashflowPaginatedType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'cashflowspaginated',
        'description' => 'Liste paginée de Cashflow',
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
                'type' => Type::listOf(GraphQL::type('Cashflow')),
                'resolve' => function ($root) {
                    return $root;
                }
            ]
        ];
    }
}