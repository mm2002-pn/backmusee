<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use App\Models\Zone;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;


class DetailblType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Detailbl',
        'description' => ''
    ];

    public function fields(): array
    {

        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'commercial' => ['type' => GraphQL::type('User'), 'description' => ''],
                'bl' => ['type' => GraphQL::type('Bl'), 'description' => ''],
                'produit' => ['type' => GraphQL::type('Produit'), 'description' => ''],
                'pointdevente' => ['type' => GraphQL::type('Pointdevente'), 'description' => ''],

                'bl_id' => ['type' => Type::int(), 'description' => ''],
                'date' => ['type' => Type::string(), 'description' => ''],
                'produit_id' => ['type' => Type::int(), 'description' => ''],
                'commercial_id' => ['type' => Type::int(), 'description' => ''],
                'pointdevente_id' => ['type' => Type::int(), 'description' => ''],
                'quantite' => ['type' => Type::string(), 'description' => ''],
                "total" => ['type' => Type::float(), 'description' => ''],
                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }

    // total_montant_vente

    public function resolveTotalField($root, $args)
    {
        // prix * qte
        return $root->produit->prix * $root->quantite;
    }
}
