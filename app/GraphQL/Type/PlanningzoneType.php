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

class PlanningzoneType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Planningzone',
        'description' => '',
    ];
    public function fields(): array
    {
        return [
            'id' => ['type' => Type::int()],
            'planning_id' => ['type' => Type::int()],
            'zone_id' => ['type' => Type::int()],
            'planning' => ['type' => GraphQL::type('Planning')],
            'zone' => ['type' => GraphQL::type('Zone')],
        ];
    }


}
