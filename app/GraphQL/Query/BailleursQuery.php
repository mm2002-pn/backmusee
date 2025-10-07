<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class BailleursQuery extends Query
{
    protected $attributes = [
        'name' => 'bailleurs',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Bailleur'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'nom' => ['type' => Type::string(), 'description' => ''],
            'pays' => ['type' => Type::string(), 'description' => ''],
            'contact' => ['type' => Type::string(), 'description' => ''],
            'emailcontact' => ['type' => Type::string(), 'description' => ''],
            'telephone' => ['type' => Type::string(), 'description' => ''],
            'fax' => ['type' => Type::string(), 'description' => ''],
            'fixe' => ['type' => Type::string(), 'description' => ''],
            'user_id' => ['type' => Type::int(), 'description' => ''],
            'estactive' => ['type' => Type::int(), 'description' => ''],


        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryBailleur($args);
        return $query->get();
    }
}
