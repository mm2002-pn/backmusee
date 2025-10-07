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

class DataType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Data',
        'description' => '',
    ];
    public function fields(): array
    {
        return [
            'name' => ['type' => Type::string()],
            'nombre' => ['type' => Type::int()],
        ];
    }
}
