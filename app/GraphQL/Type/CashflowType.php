<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CashflowType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Cashflow',
        'description' => 'Type pour le modèle Cashflow',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'week' => ['type' => Type::int(), 'description' => 'Numéro de semaine'],
            'date_debut' => ['type' => Type::string(), 'description' => 'Date de début de la période'],
            'date_fin' => ['type' => Type::string(), 'description' => 'Date de fin de la période'],
            'total_encaissements' => ['type' => Type::string(), 'description' => 'Total des encaissements'],
            'total_reglements' => ['type' => Type::string(), 'description' => 'Total des règlements'],
            'count' => ['type' => Type::string(), 'description' => 'Total des opérations'],
        ];
    }
}
