<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

class PlanninghebdomadairePaginatedType extends RefactGraphQLType
{
    protected $model = 'Planninghebdomadaire';
    protected $attributes = [
        'name' => 'planninghebdomadairespaginated',
        'description' => 'les plannings  par page'
    ];
}
