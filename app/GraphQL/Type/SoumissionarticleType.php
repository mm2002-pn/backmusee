<?php

namespace App\GraphQL\Type;

use App\Models\Aoarticle;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class SoumissionarticleType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Soumissionarticle',
        'description' => 'Type pour le modèle Soumissionarticle',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],

            'article_id' => ['type' => Type::id(), 'description' => 'article_id'],
            'soumission_id' => ['type' => Type::id(), 'description' => 'soumission_id'],
            'typecondition_id' => ['type' => Type::id(), 'description' => 'typecondition_id'],
            'pays_id' => ['type' => Type::id(), 'description' => 'pays_id'],
            'pays' => ['type' => GraphQL::type('Pays'), 'description' => 'pays'],
            'fabricant_id' => ['type' => Type::id(), 'description' => 'fabricant_id'],
            'fabricant' => ['type' => GraphQL::type('Fabricant'), 'description' => 'fabricant'],
            'datelivraison' => ['type' => Type::string(), 'description' => 'datelivraison'],


            'prixunitairepropose' => ['type' => Type::float(), 'description' => 'prixunitairepropose'],
            'quantitepropose' => ['type' => Type::float(), 'description' => 'quantitepropose'],
            'quantitedemande' => ['type' => Type::int(), 'description' => 'quantitedemande'],
            'targetprice' => ['type' => Type::float(), 'description' => 'targetprice'],
            'prequalification' => ['type' => Type::int(), 'description' => 'prequalification'],
            'statutamm' => ['type' => Type::int(), 'description' => 'statutamm'],
            'presenceechantillon' => ['type' => Type::int(), 'description' => 'presenceechantillon'],
            'presencedossierstech' => ['type' => Type::int(), 'description' => 'presencedossierstech'],
            'observationsaq' => ['type' => Type::string(), 'description' => 'observationsaq'],
            'resultatevaluation' => ['type' => Type::string(), 'description' => 'resultatevaluation'],
            'isselected' => ['type' => Type::int(), 'description' => 'isselected'],
            'score' => ['type' => Type::float(), 'description' => 'score'],
            'typecondition_text' => ['type' => Type::string(), 'description' => 'score'],
            'coeff' => ['type' => Type::float(), 'description' => 'score'],


            'article' => [
                'type' => GraphQL::type('Article'),
                'description' => 'articles'
            ],
            'soumission' => [
                'type' => GraphQL::type('Soumission'),
                'description' => 'soumissions'
            ],
            'typecondition' => [
                'type' => GraphQL::type('Typecondition'),
                'description' => 'typeconditions'
            ],
            'pays' => [
                'type' => GraphQL::type('Pays'),
                'description' => 'pays'
            ],

            'delailivraison' => ['type' => Type::int(), 'description' => 'score'],
            'dureedevie' => ['type' => Type::int(), 'description' => 'score'],
            'dateperemption' => ['type' => Type::string(), 'description' => 'score'],

            
        ];
        
       
    }



}
