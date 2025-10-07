<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class HistogrammesQuery extends Query
{
    protected $attributes = [
        'name' => 'histogrammes'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Histogramme'));
    }

    public function args(): array
    {
        return
            [

                'produit_id' => ['type' => Type::int(), 'description' => 'Product ID'],
                'quantite_totale' => ['type' => Type::float(), 'description' => 'Total quantity sold'],
                'chiffre_affaires' => ['type' => Type::float(), 'description' => 'Total revenue (Chiffre d\'Affaires)'],

                'date' => ['type' => Type::string(), 'description' => ''],
                'datefin' => ['type' => Type::string(), 'description' => ''],
                'commercial_id' => ['type' => Type::int(), 'description' => ''],
                'est_activer' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryHistogramme($args);
        // dd($query,"query");
        return $query->get();
    }
}
