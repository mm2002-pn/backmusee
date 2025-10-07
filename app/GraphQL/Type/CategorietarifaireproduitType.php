<?php

namespace App\GraphQL\Type;


use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;


class CategorietarifaireproduitType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Categorietarifaireproduit',
        'description' => ''
    ];

    public function fields(): array
    {
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],

                'categorietarifaire_id' => ['type' => Type::int(), 'description' => ''],
                'categorietarifaire' => ['type' => GraphQL::type('Categorietarifaire'), 'description' => ''],
                'produit' => ['type' => GraphQL::type('Produit'), 'description' => ''],
                'produit_id' => ['type' => Type::int(), 'description' => ''],


                'unite' => ['type' => GraphQL::type('Unite'), 'description' => ''],
                'unite_id' => ['type' => Type::int(), 'description' => ''],


                // prix
                'prix' => ['type' => Type::string(), 'description' => ''],
                // remise_achat en float
                'remise_achat' => ['type' => Type::float(), 'description' => ''],
                'remise' => ['type' => Type::float(), 'description' => ''],



                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }
}
