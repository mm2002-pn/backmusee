<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AoarticleType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Aoarticle',
        'description' => 'Type pour le modèle Aoarticle',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            // Ajouter d'autres champs ici

            'margevaleur' => ['type' => Type::string(), 'description' => ''],
            'margepourcentage' => ['type' => Type::string(), 'description' => ''],
            'ao_id' => ['type' => Type::id(), 'description' => ''],
            'article_id' => ['type' => Type::id(), 'description' => ''],
            'ao' => ['type' => GraphQL::type('Ao'), 'description' => ''],
            'article' => ['type' => GraphQL::type('Article'), 'description' => ''],
            'quantite' => ['type' => Type::float(), 'description' => ''],
            'targetprice' => ['type' => Type::float(), 'description' => ''],
            'coeff' => ['type' => Type::float(), 'description' => ''],
            'targetpricestatus' => ["type" => Type::int(), 'descrition' => ''],

            'created_at' => ['type' => Type::string(), 'description' => ''],
            'updated_at' => ['type' => Type::string(), 'description' => ''],
        ];
    }

    protected function resolveTargetpricestatusField($root, $args)
    {
        return 1;
        
       // return Outil::getEtatTargetPriceAo($root['id']);
    }
}
