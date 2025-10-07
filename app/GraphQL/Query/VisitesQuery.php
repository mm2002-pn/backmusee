<?php

namespace App\GraphQL\Query;

use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class VisitesQuery extends Query
{
    protected $attributes = [
        'name' => 'visites',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Visite'));
    }

    public function args(): array
    {
        return
            [
                'id' => ['type' => Type::int()],
                'commercial_id' => ['type' => Type::int(), 'description' => ''],
                'pointdevente_id' => ['type' => Type::int(), 'description' => ''],
                'date' => ['type' => Type::string(), 'description' => ''],
                'datefin' => ['type' => Type::string(), 'description' => ''],
                'antenne' => ['type' => Type::string(), 'description' => ''],
                'commercial' => ['type' => GraphQL::type('User'), 'description' => ''],

                // montantencaissement
                'montantencaissement' => ['type' => Type::float(), 'description' => ''],

                'commentaire' => ['type' => Type::string(), 'description' => ''],
                'planning_id' => ['type' => Type::int(), 'description' => ''],
                'planning' => ['type' => GraphQL::type('Planning'), 'description' => ''],
                'zone_id' => ['type' => Type::int(), 'description' => ''],
                'voiture_id' => ['type' => Type::int(), 'description' => ''],

                'etatquantite' => ['type' => Type::int(), 'description' => ''],
                //etatmateriel
                'etatmateriel' => ['type' => Type::int(), 'description' => ''],
                //etatencaissement   
                'etatrecouvrement' => ['type' => Type::int(), 'description' => ''],
                'etatreglement' => ['type' => Type::int(), 'description' => ''],
                "antenne_id" => ['type' => Type::int()],

                'est_activer' => ['type' => Type::int()],
                'order'          => ['type' => Type::string()],
                'direction'      => ['type' => Type::string()],



            ];
    }

    public function resolve($root, $args)
    {
        $query = QueryModel::getQueryVisite($root, $args);
        $results = $query->get();

        $isarticlevalidate = 1;

        foreach ($results as $result) {
            if ($result->detaillivraisons->count() > 0) {
                if ($result->etatquantite != 1) {
                    $isarticlevalidate = 0;
                    break;
                }
                break;
            }
        }


        $ismaterielvalidate = 1;

        foreach ($results as $result) {
            if ($result->detailmateriels->count() > 0) {
                if ($result->etatmateriel != 1) {
                    $ismaterielvalidate = 0;
                    break;
                }
            }
        }


        // Injecter `isvalidate` dans chaque objet visite
        foreach ($results as $result) {
            $result->isarticlevalidate = $isarticlevalidate;
            $result->ismaterielvalidate = $ismaterielvalidate;
            $result->queryArgs = $args; // Injecter les arguments dans l'objet
        }

        return $results;
    }
}
