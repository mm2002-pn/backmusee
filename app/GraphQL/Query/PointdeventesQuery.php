<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use PhpParser\Node\Expr\List_;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class PointdeventesQuery extends Query
{
    protected $attributes = [
        'name' => 'pointdeventes',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Pointdevente'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'designation' => ['type' => Type::string(), 'description' => ''],
                'intitule' => ['type' => Type::string(), 'description' => ''],
                'numbcpttier' => ['type' => Type::string(), 'description' => ''],
                'adresse' => ['type' => Type::string(), 'description' => ''],
                'telephone' => ['type' => Type::string(), 'description' => ''],
                'images' => ['type' => Type::string(), 'description' => ''],
                'email' => ['type' => Type::string(), 'description' => ''],
                'gps' => ['type' => Type::string(), 'description' => ''],
                'zone_id' => ['type' => Type::int(), 'description' => ''],
                'refactid' => ['type' => Type::int(), 'description' => ''],
                'detailmateriels_count' => ['type' => Type::int(), 'description' => ''],
                'detaillivraisons_count' => ['type' => Type::int(), 'description' => ''],
                'estdivers' => ['type' => Type::int(), 'description' => ''],


                // ventedirect
                'ventedirect' => ['type' => Type::string(), 'description' => ''],

                // etat

                'etat' => ['type' => Type::string(), 'description' => ''],

                'latitude' => ['type' => Type::string(), 'description' => ''],
                'longitude' => ['type' => Type::string(), 'description' => ''],
                'ids_zone' => ['type' => Type::listOf(Type::int()), 'description' => ''],
                "img_local" => ['type' => Type::string(), 'description' => ''],

                'reglements_count' => ['type' => Type::int(), 'description' => ''],
                'recouvrements_count' => ['type' => Type::int(), 'description' => ''],
                'date' => ['type' => Type::string(), 'description' => ''],
                'client_id' => ['type' => Type::int(), 'description' => ''],
                'zone_id' => ['type' => Type::int(), 'description' => ''],
                'est_activer' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],
            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryPointdevente($args);
        $results = $query->get();
        // dd($results);
        if (isset($args['refactid']) && $args['refactid'] != null) {
            foreach ($results as $pointdevente) {
                $pointdevente->detailmateriels_count = $pointdevente['detailmateriels_count'];
                $pointdevente->detaillivraisons_count = $pointdevente['detaillivraisons_count'];
                $pointdevente->recouvrements_count = $pointdevente['recouvrements_count'];
                $pointdevente->reglements_count = $pointdevente['reglements_count'];
                $pointdevente->date = $pointdevente['date'];
            }
        }


        return $results;
    }
}
