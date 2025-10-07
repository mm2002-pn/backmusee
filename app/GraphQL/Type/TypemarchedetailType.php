<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TypemarchedetailType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Typemarchedetail',
        'description' => 'Type pour le modèle ',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'position' => ['type' => Type::string(), 'description' => ''],
            'description' => ['type' => Type::string(), 'description' => ''],
            'typemarche_id' => ['type' => Type::int(), 'description' => ''],
            'parcourmarche_id' => ['type' => Type::int(), 'description' => ''],
            'typemarche' => ['type' => GraphQL::type('Typemarche'), 'description' => ''],
            'parcourmarche' => ['type' => GraphQL::type('Parcourmarche'), 'description' => ''],
            'detailtypemarchedetails' => ['type' => Type::listOf(GraphQL::type('Detailtypemarchedetail')), 'description' => ''],

        ];
    }
}
