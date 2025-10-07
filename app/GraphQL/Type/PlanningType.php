<?php

namespace App\GraphQL\Type;

use App\Models\User;
use App\Models\Planning;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Models\RefactoringItems\RefactGraphQLType;

class PlanningType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Planning',
        'description' => '',
    ];
    public function fields(): array
    {
        return [
            'id' => ['type' => Type::int()],
            'user_id' => ['type' => Type::int()],
            'user' => ['type' => GraphQL::type('User')],
            'voiture_id' => ['type' => Type::int()],
            'voiture' => ['type' => GraphQL::type('Voiture')],
            'chauffeur_id' => ['type' => Type::int()],
            'chauffeur' => ['type' => GraphQL::type('User')],
            'refactid' => ['type' => Type::int()],
            'date' => ['type' => Type::string()],
            'datesemaine' => ['type' => Type::string()],
            'status' => ['type' => Type::int()],
            'commentaire' => ['type' => Type::string()],
            'address' => ['type' => Type::string()],
            'budget' => ['type' => Type::string()],
            'planningzones' => ['type' => Type::listOf(GraphQL::type('Planningzone'))],
            'planningproduits' => ['type' => Type::listOf(GraphQL::type('Planningproduit'))],

            // planningusers
            'planningusers' => ['type' => Type::listOf(GraphQL::type('Planninguser'))],

            // users
            'users' => ['type' => Type::listOf(GraphQL::type('User'))],
            // planningequipements
            'planningequipements' => ['type' => Type::listOf(GraphQL::type('Planningequipement'))],
        ];
    }
    protected function resolveChauffeurField($root, $args)
    {
        return User::find($root->chauffeur_id);
    }

    protected function resolveRefactidField($root, $args)
    {
        return Planning::find($root->id)->id;
    }
}
