<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;


class ProduitType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Produit',
        'description' => ''
    ];

    public function fields(): array
    {
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'designation' => ['type' => Type::string(), 'description' => ''],
                'description' => ['type' => Type::string(), 'description' => ''],
                'code' => ['type' => Type::string(), 'description' => ''],
                'prix' => ['type' => Type::string(), 'description' => ''],
                // prixconseille
                'prixconseille' => ['type' => Type::string(), 'description' => ''],

                // prixconseillerdetailland
                'prixconseillerdetaillant' => ['type' => Type::float(), 'description' => ''],
                // prixconseillerclient
                'prixconseillerclient' => ['type' => Type::float(), 'description' => ''],

                // colisage
                'colisage' => ['type' => Type::int(), 'description' => ''],
                'categorie' => ['type' => GraphQL::type('Categorie'), 'description' => ''],
                'categorie_id' => ['type' => Type::int(), 'description' => ''],
                'image' => ['type' => Type::string(), 'description' => ''],

                // categorietarifaireproduits
                'categorietarifaireproduits' => ['type' => Type::listOf(GraphQL::type('Categorietarifaireproduit')), 'description' => ''],
                'isdisplay' => ['type' => Type::int()],

                // unite
                'unite' => ['type' => GraphQL::type('Unite'), 'description' => ''],
                'unite_id' => ['type' => Type::int(), 'description' => ''],

                'totalqte' => ['type' => Type::int(), 'description' => ''],
                'totalamont' => ['type' => Type::float(), 'description' => ''],

                //imgurl
                'imgurl' => ['type' => Type::string(), 'description' => ''],
                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }


    // totalqte en se basnt sur la table detaillivraison
    public function resolveTotalqteField($root, $args)
    {
        return $root->detaillivraisons()->sum('quantite');
    }

    // totalamont en se basnt sur la table detaillivraison qunte * prix
    public function resolveTotalamontField($root, $args)
    {
        return $root->detaillivraisons->sum(function ($item) {
            return $item->quantite * $item->prix;
        });
    }
}
