<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;


class DetaillivraisonType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Detaillivraison',
        'description' => ''
    ];

    public function fields(): array
    {

        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'visite_id' => ['type' => Type::int(), 'description' => ''],
                'produit_id' => ['type' => Type::int(), 'description' => ''],
                'quantite' => ['type' => Type::string(), 'description' => ''],
                'visite' => ['type' => GraphQL::type('Visite'), 'description' => ''],
                'produit' => ['type' => GraphQL::type('Produit'), 'description' => ''],

                'unite_id' => ['type' => Type::int(), 'description' => ''],
                'unite' => ['type' => GraphQL::type('Unite'), 'description' => ''],

                // prix
                'prix' => ['type' => Type::int(), 'description' => ''],

                // total
                'total' => ['type' => Type::int(), 'description' => ''],


                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }


    //total

    public function resolveTotalField($root, $args)
    {
        return $root->quantite * $root->prix;
    }
}
