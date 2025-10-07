<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CategorietarifairesQuery extends Query
{
    protected $attributes = [
        'name' => 'categorietarifaires'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Categorietarifaire'));
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::int()],
            'designation' => ['type' => Type::string()],
            'description' => ['type' => Type::string(), 'description' => ''],
          

            'order' => ['type' => Type::string()],
            'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryCategorietarifaire($args);
        return $query->get();
    }

    private function organizeSouscategories($souscategories, $parentId = null)
    {
        $organized = [];

        foreach ($souscategories as $souscategorie) {
            if ($souscategorie->souscategorie_id == $parentId) {
                $souscategorie->souscategories = $this->organizeSouscategories($souscategorie->souscategories, $souscategorie->id);
                $organized[] = $souscategorie;
            }
        }

        return $organized;
    }
}
