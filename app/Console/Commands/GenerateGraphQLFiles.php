<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class GenerateGraphQLFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:graphql {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Génère les fichiers Type, PaginatedType, Query et PaginateQuery pour un modèle donné';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $model = $this->argument('model');

        $modelClass = Str::studly($model);


        $typePath = app_path("GraphQL/Type/{$modelClass}Type.php");
        $paginatedTypePath = app_path("GraphQL/Type/{$modelClass}PaginatedType.php");
        $queryPath = app_path("GraphQL/Query/{$modelClass}sQuery.php");
        $paginateQueryPath = app_path("GraphQL/Query/{$modelClass}PaginatedQuery.php");

        // Générer chaque fichier
        $this->generateType($modelClass, $typePath);
        $this->generatePaginatedType($modelClass, $paginatedTypePath);
        $this->generateQuery($modelClass, $queryPath);
        $this->generatePaginateQuery($modelClass, $paginateQueryPath);

        $this->info('Fichiers générés avec successe');

        return 0;
    }


    protected function generateType($model, $path)
    {
                        $content = <<<PHP
                        <?php
                        namespace App\GraphQL\Type;

                        use App\Models\RefactoringItems\RefactGraphQLType;
                        use GraphQL\Type\Definition\Type;
                        use Rebing\GraphQL\Support\Facades\GraphQL;

                        class {$model}Type extends RefactGraphQLType
                        {
                            protected \$attributes = [
                                'name' => '{$model}',
                                'description' => 'Type pour le modèle $model',
                            ];

                            public function fields(): array
                            {
                                return [
                                    'id' => ['type' => Type::id(), 'description' => ''],
                                    // Ajouter d'autres champs ici
                                ];
                            }
                        }
                        PHP;

        $this->createFile($path, $content);
    }





    protected function generatePaginatedType($model, $path)
    {
                    $tolowwermodel = Str::lower($model);
                    $content = <<<PHP
                    <?php
                    namespace App\GraphQL\Type;

                    use App\Models\RefactoringItems\RefactGraphQLType;

                    use GraphQL\Type\Definition\Type;
                    use Rebing\GraphQL\Support\Facades\GraphQL;

                    class {$model}PaginatedType extends RefactGraphQLType
                    {
                        protected \$attributes = [
                            'name' => '{$tolowwermodel}spaginated',
                            'description' => 'Liste paginée de {$model}',
                        ];

                        public function fields(): array
                        {
                            return [

                                'metadata' => [
                                    'type' => GraphQL::type('Metadata'),
                                    'resolve' => function (\$root) {
                                        return array_except(\$root->toArray(), ['data']);
                                    }
                                ],

                                'data' => [
                                    'type' => Type::listOf(GraphQL::type('{$model}')),
                                    'resolve' => function (\$root) {
                                        return \$root;
                                    }
                                ]
                            ];
                        }
                    }
                    PHP;
        $this->createFile($path, $content);
    }

    protected function generateQuery($model, $path)
    {
        $modeltolower = Str::lower($model);
        $plural = Str::plural($modeltolower);
                
        $content = <<<PHP
        <?php
        namespace App\GraphQL\Query;

        use App\Models\QueryModel;
        use GraphQL\Type\Definition\Type;
        use Rebing\GraphQL\Support\Query;
        use Rebing\GraphQL\Support\Facades\GraphQL;

        class {$model}sQuery extends Query
        {
        protected \$attributes = [
        'name' => '{$plural}',
        ];

        public function type(): Type
        {
        return Type::listOf(GraphQL::type('{$model}'));
        }


        public function args(): array
        {
        return [

        ];
        }

        public function resolve(\$root, \$args)
        {
        \$query = QueryModel::getQuery{$model}(\$args);
        return \$query->get();
        }
        }
        PHP;
        $this->createFile($path, $content);
    }



    protected function generatePaginateQuery($model, $path)
    {
        $modeltolower = Str::lower($model);
        $content = <<<PHP
        <?php
        namespace App\GraphQL\Query;
        use App\Models\QueryModel;
        use GraphQL\Type\Definition\Type;
        use Rebing\GraphQL\Support\Query;
        use Rebing\GraphQL\Support\Facades\GraphQL;
        use Illuminate\Support\Arr;
        class {$model}PaginatedQuery extends Query
        {
            protected \$attributes = [
                'name' => '{$modeltolower}spaginated',
            ];

            public function type(): Type
            {
                return GraphQL::type('{$modeltolower}spaginated');
            }

            public function args(): array
            {
                return [
                'page' => ['type' => Type::int()],
                'count' => ['type' => Type::int()],
                'order' => ['type' => Type::string()],
                'direction' => ['type' => Type::string()],
                ];
            }

            public function resolve(\$root, \$args)
            {
                 \$query = QueryModel::getQuery{$model}(\$args);
                  \$count = Arr::get(\$args, 'count', 20);
                  \$page = Arr::get(\$args, 'page', 1);
                  return \$query->paginate(\$count, ['*'], 'page', \$page);
            }
        }
        PHP;

        $this->createFile($path, $content);
    }

    protected function createFile($path, $content)
    {
        if (!File::exists(dirname($path))) {
            File::makeDirectory(dirname($path), 0755, true);
        }

        if (File::exists($path)) {
            $this->warn("Le fichier existe déjà : $path");
            return;
        }

        File::put($path, $content);
        $this->info("Fichier créé : $path");
    }
}
