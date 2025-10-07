<?php

namespace App\GraphQL\Type;

use App\Models\Pointdevente;
use App\Models\RefactoringItems\RefactGraphQLType;
use App\Models\User;
use App\Models\Visite;
use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;


class HistogrammebestclientType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Histogrammebestclient',
        'description' => ''
    ];

    public function fields(): array
    {
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'intitule' => ['type' => Type::string(), 'description' => ''],
                'ca' => ['type' => Type::float(), 'description' => ''],
                'total_quantite' => ['type' => Type::float(), 'description' => ''],
                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }
}
