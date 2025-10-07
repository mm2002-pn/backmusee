<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DocumentspecificationsQuery extends Query
{
    protected $attributes = [
        'name' => 'documentspecifications',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Documentspecification'));
    }


    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],
            'etape' => ['type' => Type::int(), 'description' => ''],
            'etatetexte' => ['type' => Type::string(), 'description' => ''],
            'designation' => ['type' => Type::string(), 'description' => ''],
            'nature' => ['type' => Type::string(), 'description' => ''],
            'section' => ['type' => Type::int(), 'description' => ''],
            'sectiontexte' => ['type' => Type::string(), 'description' => ''],
            'typemarche_id' => ['type' => Type::int(), 'description' => ''],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryDocumentspecification($args);
        return $query->get();
    }
}
