<?php



declare(strict_types=1);



return [

    // The prefix for routes
    'prefix' => 'graphql',

    // The routes to make GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Route
    //
    // Example:
    //
    // Same route for both query and mutation
    //
    // 'routes' => 'path/to/query/{graphql_schema?}',
    //
    // or define each route
    //
    // 'routes' => [
    //     'query' => 'query/{graphql_schema?}',
    //     'mutation' => 'mutation/{graphql_schema?}',
    // ]
    //
    'routes' => '{graphql_schema?}',

    // The controller to use in GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Controller and method
    //
    // Example:
    //
    // 'controllers' => [
    //     'query' => '\Rebing\GraphQL\GraphQLController@query',
    //     'mutation' => '\Rebing\GraphQL\GraphQLController@mutation'
    // ]
    //
    'controllers' => \Rebing\GraphQL\GraphQLController::class . '@query',

    // Any middleware for the graphql route group
    'middleware' => ['check.auth'],

    // Additional route group attributes
    //
    // Example:
    //
    // 'route_group_attributes' => ['guard' => 'api']
    //
    'route_group_attributes' => [],

    // The name of the default schema used when no argument is provided
    // to GraphQL::schema() or when the route is used without the graphql_schema
    // parameter.
    'default_schema' => 'default',

    // The schemas for query and/or mutation. It expects an array of schemas to provide
    // both the 'query' fields and the 'mutation' fields.
    //
    // You can also provide a middleware that will only apply to the given schema
    //
    // Example:
    //
    //  'schema' => 'default',
    //
    //  'schemas' => [
    //      'default' => [
    //          'query' => [
    //              'users' => 'App\GraphQL\Query\UsersQuery'
    //          ],
    //          'mutation' => [
    //
    //          ]
    //      ],
    //      'user' => [
    //          'query' => [
    //              'profile' => 'App\GraphQL\Query\ProfileQuery'
    //          ],
    //          'mutation' => [
    //
    //          ],
    //          'middleware' => ['auth'],
    //      ],
    //      'user/me' => [
    //          'query' => [
    //              'profile' => 'App\GraphQL\Query\MyProfileQuery'
    //          ],
    //          'mutation' => [
    //
    //          ],
    //          'middleware' => ['auth'],
    //      ],
    //  ]
    //

    'schemas' => [
        'default' => [
            'query' => [
                // ExampleQuery::class,
                \App\GraphQL\Query\UsersQuery::class,
                \App\GraphQL\Query\UserPaginatedQuery::class,
                \App\GraphQL\Query\PermissionsQuery::class,
                \App\GraphQL\Query\PermissionPaginatedQuery::class,
                \App\GraphQL\Query\RolesQuery::class,
                \App\GraphQL\Query\RolePaginatedQuery::class,
                \App\GraphQL\Query\ClientsQuery::class,
                \App\GraphQL\Query\ClientPaginatedQuery::class,
                \App\GraphQL\Query\PointdeventesQuery::class,
                \App\GraphQL\Query\PointdeventePaginatedQuery::class,
                \App\GraphQL\Query\ZonesQuery::class,
                \App\GraphQL\Query\ZonePaginatedQuery::class,
                \App\GraphQL\Query\ZonepointdeventesQuery::class,
                \App\GraphQL\Query\ZonepointdeventePaginatedQuery::class,
                \App\GraphQL\Query\PlanninghebdomadairesQuery::class,
                \App\GraphQL\Query\PlanninghebdomadairePaginatedQuery::class,
                \App\GraphQL\Query\VoituresQuery::class,
                \App\GraphQL\Query\VoiturePaginatedQuery::class,
                \App\GraphQL\Query\ProduitsQuery::class,
                \App\GraphQL\Query\ProduitPaginatedQuery::class,
            ],
            'mutation' => [
                // 'example_mutation'  => ExampleMutation::class,
            ],
            // The types only available in this schema
            'types' => [],

            // Laravel HTTP middleware
            'middleware' =>  ['check.auth'],

            // Which HTTP methods to support; must be given in UPPERCASE!
            'method' => ['GET', 'POST'],

            // An array of middlewares, overrides the global ones
            'execution_middleware' => null,
        ],
    ],

    // The types available in the application. You can then access it from the
    // facade like this: GraphQL::type('user')
    //
    // Example:
    //
    // 'types' => [
    //     'user' => 'App\GraphQL\Type\UserType'
    // ]
    //
    'types' => [
        // ExampleType::class,
        // ExampleRelationType::class,
        // \Rebing\GraphQL\Support\UploadType::class,
        // ExampleType::class,

        \App\GraphQL\Type\Metadata::class,
        \App\GraphQL\Type\UserType::class,
        \App\GraphQL\Type\UserPaginatedType::class,
        \App\GraphQL\Type\RoleType::class,
        \App\GraphQL\Type\RolePaginatedType::class,
        \App\GraphQL\Type\PermissionPaginatedType::class,
        \App\GraphQL\Type\PermissionType::class,
        \App\GraphQL\Type\ClientType::class,
        \App\GraphQL\Type\ClientPaginatedType::class,
        \App\GraphQL\Type\PointdeventeType::class,
        \App\GraphQL\Type\PointdeventePaginatedType::class,
        \App\GraphQL\Type\ZoneType::class,
        \App\GraphQL\Type\ZonePaginatedType::class,
        \App\GraphQL\Type\ZonepointdeventeType::class,
        \App\GraphQL\Type\ZonepointdeventePaginatedType::class,
        \App\GraphQL\Type\PlanninghebdomadaireType::class,
        \App\GraphQL\Type\PlanninghebdomadairePaginatedType::class,
        \App\GraphQL\Type\VoitureType::class,
        \App\GraphQL\Type\VoiturePaginatedType::class,
        \App\GraphQL\Type\ProduitType::class,
        \App\GraphQL\Type\ProduitPaginatedType::class,

    ],

    // The types will be loaded on demand. Default is to load all types on each request
    // Can increase performance on schemes with many types
    // Presupposes the config type key to match the type class name property
    'lazyload_types' => false,

    // This callable will be passed the Error object for each errors GraphQL catch.
    // The method should return an array representing the error.
    // Typically:
    // [
    //     'message' => '',
    //     'locations' => []
    // ]
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],

    /*
     * Custom Error Handling
     *
     * Expected handler signature is: function (array $errors, callable $formatter): array
     *
     * The default handler will pass exceptions to laravel Error Handling mechanism
     */
    'errors_handler' => ['\Rebing\GraphQL\GraphQL', 'handleErrors'],

    // You can set the key, which will be used to retrieve the dynamic variables
    'params_key' => 'variables',

    /*
     * Options to limit the query complexity and depth. See the doc
     * @ https://webonyx.github.io/graphql-php/security
     * for details. Disabled by default.
     */
    'security' => [
        'query_max_complexity' => 0,
        'query_max_depth' => 0,
        'disable_introspection' => true,
    ],

    /*
     * You can define your own pagination type.
     * Reference \Rebing\GraphQL\Support\PaginationType::class
     */
    'pagination_type' => \Rebing\GraphQL\Support\PaginationType::class,

    /*
     * Config for GraphiQL (see (https://github.com/graphql/graphiql).
     */
    'graphiql' => [
        'prefix' => '/graphiql',
        'controller' => \Rebing\GraphQL\GraphQLController::class . '@graphiql',
        'middleware' => ['web', 'auth'],
        'view' => 'graphql::graphiql',
        'display' => env('ENABLE_GRAPHIQL', false),
    ],

    /*
     * Overrides the default field resolver
     * See http://webonyx.github.io/graphql-php/data-fetching/#default-field-resolver
     *
     * Example:
     *
     * ```php
     * 'defaultFieldResolver' => function ($root, $args, $context, $info) {
     * },
     * ```
     * or
     * ```php
     * 'defaultFieldResolver' => [SomeKlass::class, 'someMethod'],
     * ```
     */
    'context' => [
        'request' => 'Illuminate\Http\Request',
    ],

    'defaultFieldResolver' => null,

    /*
     * Any headers that will be added to the response returned by the default controller
     */
    'headers' => [],

    /*
     * Any JSON encoding options when returning a response from the default controller
     * See http://php.net/manual/function.json-encode.php for the full list of options
     */
    'json_encoding_options' => 0,
];
