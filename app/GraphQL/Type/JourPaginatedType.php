<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

class JourPaginatedType extends RefactGraphQLType
{
    protected $model = 'Jour';
    protected $attributes = [
        'name' => 'jourspaginated',
        'description' => 'les plannings  par page'
    ];
}
