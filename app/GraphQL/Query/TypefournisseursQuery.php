<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TypefournisseursQuery extends Query
{
    protected $attributes = [
        'name' => 'typefournisseurs',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Typefournisseur'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            // Ajouter d'autres champs ici
            'designation' => ['type' => Type::string(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryTypefournisseur($args);
        return $query->get();
    }
}
