<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;


class EncaissementType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Encaissement',
        'description' => ''
    ];

    public function fields(): array
    {   
       
       
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'numfacture' => ['type' => Type::string(), 'description' => ''],
                'montantaregle' => ['type' => Type::string(), 'description' => ''],
                'montantrecouvrement' => ['type' => Type::string(), 'description' => ''],
                'montantreglement' => ['type' => Type::string(), 'description' => ''],
                //montantrecuperer
                'montantrecuperer' => ['type' => Type::string(), 'description' => ''],
                'typeencaissement_id' => ['type' => Type::int(), 'description' => ''],
                'typeencaissement' => ['type' => GraphQL::type('Typeencaissement'), 'description' => ''],
                //isreglement
                'isreglement' => ['type' => Type::int(), 'description' => ''],
                'visite_id' => ['type' => Type::int(), 'description' => ''],
                'visite' => ['type' => GraphQL::type('Visite'), 'description' => ''],

                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }
}
