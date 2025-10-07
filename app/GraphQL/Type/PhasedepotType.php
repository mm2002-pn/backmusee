<?php

namespace App\GraphQL\Type;

use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class PhasedepotType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Phasedepot',
        'description' => 'Type pour le modèle Phasedepot',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'datedeb' => ['type' => Type::string(), 'description' => ''],
            'datefin' => ['type' => Type::string(), 'description' => ''],
            'campagne_id' => ['type' => Type::id(), 'description' => ''],
            'etat' => ['type' => Type::int(), 'description' => ''],
            'campagne' => ['type' => GraphQL::type("Campagne"), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'description' => ['type' => Type::string(), 'description' => ''],
        ];
    }



    public function resolveDatefinField($root, $args)
    {
        // dd($root);
        return $root->datefin;
    }
}
