<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use App\Models\User;
use App\Models\Visite;
use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;


class HistogrammeType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Histogramme',
        'description' => ''
    ];

    public function fields(): array
    {
        return
            [
                'produit_id' => ['type' => Type::int(), 'description' => 'Product ID'],
                'quantite_totale' => ['type' => Type::float(), 'description' => 'Total quantity sold'],
                'chiffre_affaires' => ['type' => Type::float(), 'description' => 'Total revenue (Chiffre d\'Affaires)'],
                'produit' => ['type' => GraphQL::type('Produit'), 'description' => 'Product details'],
                'total_quantite' => ['type' => Type::float(), 'description' => 'Total quantity sold'],
                'total_ca' => ['type' => Type::float(), 'description' => 'Total revenue (Chiffre d\'Affaires)'],

                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }



    // total_ca

    
}
