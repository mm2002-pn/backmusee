<?php
namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DetailtypemarchedetailType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Detailtypemarchedetail',
        'description' => 'Type pour le modèle Detailtypemarchedetail',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'role_id' => ['type' => Type::id(), 'description' => ''],
            'typemarchedetail_id' => ['type' => Type::id(), 'description' => ''],
            'role' => ['type' => GraphQL::type('Role'), 'description' => ''],
            'typemarchedetail' => ['type' => GraphQL::type('Typemarchedetail'), 'description' => ''],
        ];
    }
}