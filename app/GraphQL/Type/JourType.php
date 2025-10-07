<?php

namespace App\GraphQL\Type;

use App\Models\User;
use App\Models\Outil;
use App\Models\Planning;
use App\Models\Intervention;
use App\Models\Planninguser;
use App\Models\Detaildepense;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Models\RefactoringItems\RefactGraphQLType;

class JourType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Jour',
        'description' => '',
    ];
    public function fields(): array
    {
        return [
            'id' => ['type' => Type::int()],
            'name' => ['type' => Type::string()],
            'planning' => ['type' => GraphQL::type('Planning')],
        ];
    }
}
