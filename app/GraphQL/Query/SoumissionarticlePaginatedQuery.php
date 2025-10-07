<?php
namespace App\GraphQL\Query;
use App\Models\QueryModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Arr;
class SoumissionarticlePaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'soumissionarticlespaginated',
    ];

    public function type(): Type
    {
        return GraphQL::type('soumissionarticlespaginated');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::id(), 'description' => ''],

            'article_id' => ['type' => Type::id(), 'description' => 'article_id'],
            'soumission_id' => ['type' => Type::id(), 'description' => 'soumission_id'],
            'typecondition_id' => ['type' => Type::id(), 'description' => 'typecondition_id'],
            'pays_id' => ['type' => Type::id(), 'description' => 'pays_id'],
            'quantitepropose' => ['type' => Type::float(), 'description' => 'quantitepropose'],
            'datelivraison' => ['type' => Type::string(), 'description' => 'datelivraison'],


            'prixunitairepropose' => ['type' => Type::float(), 'description' => 'prixunitairepropose'],
            'prequalification' => ['type' => Type::int(), 'description' => 'prequalification'],
            'statutamm' => ['type' => Type::int(), 'description' => 'statutamm'],
            'presenceechantillon' => ['type' => Type::int(), 'description' => 'presenceechantillon'],
            'presencedossierstech' => ['type' => Type::int(), 'description' => 'presencedossierstech'],
            'observationsaq' => ['type' => Type::string(), 'description' => 'observationsaq'],
            'resultatevaluation' => ['type' => Type::string(), 'description' => 'resultatevaluation'],
            'isselected' => ['type' => Type::int(), 'description' => 'isselected'],
            'score' => ['type' => Type::float(), 'description' => 'score'],

        'page' => ['type' => Type::int()],
        'count' => ['type' => Type::int()],
        'order' => ['type' => Type::string()],
        'direction' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
         $query = QueryModel::getQuerySoumissionarticle($args);
          $count = Arr::get($args, 'count', 20);
          $page = Arr::get($args, 'page', 1);
          return $query->paginate($count, ['*'], 'page', $page);
    }
}