<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ParkingType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Parking',
        'description' => 'Type pour le modèle Parking',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'fournisseur_id' => ['type' => Type::int(), 'description' => ''],
            'vehicule_id' => ['type' => Type::int(), 'description' => ''],


            'vehicule' => ['type' => GraphQL::type("Vehicule"), 'description' => ''],
            'fournisseur' => ['type' => GraphQL::type("Fournisseur"), 'description' => ''],
        ];
    }
}
