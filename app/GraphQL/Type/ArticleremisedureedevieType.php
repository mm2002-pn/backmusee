<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ArticleremisedureedevieType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Articleremisedureedevie',
        'description' => 'Type pour le modèle Articleremisedureedevie',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'article_id' => ['type' => Type::int(), 'description' => ''],
            'remisedureedevie_id' => ['type' => Type::int(), 'description' => ''],


            'date' => ['type' => Type::string(), 'description' => ''],
            'remisevaleur' => ['type' => Type::float(), 'description' => ''],
            'remisepourcentage' => ['type' => Type::float(), 'description' => ''],



            'remisedureedevie' => ['type' => GraphQL::type('Remisedureedevie'), 'description' => ''],

            'article' => ['type' => GraphQL::type('Article'), 'description' => ''],
        ];
    }
}
