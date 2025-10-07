<?php

namespace App\GraphQL\Type;

use App\Models\Client;
use App\Models\User;
use App\Outil;


use Psy\Util\Str;
use App\Detailpaiement;
use Illuminate\Support\Carbon;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;
use App\Models\RefactoringItems\RefactGraphQLType;
use GraphQL\Type\Definition\ListOfType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ClientType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Client',
        'description' => ''
    ];

    public function  fields(): array
    {
        return
            [
                'id' => ['type' => Type::id(), 'description' => ''],
                'COMPTE_0' => ['type' => Type::string(), 'description' => ''],
                'designation' => ['type' => Type::string(), 'description' => ''],
                'telfixe' => ['type' => Type::string(), 'description' => ''],
                'telmobile' => ['type' => Type::string(), 'description' => ''],
                'region' => ['type' => Type::string(), 'description' => ''],
                'TYPE_CLIENT_0' => ['type' => Type::string(), 'description' => ''],
                'district' => ['type' => Type::string(), 'description' => ''],
                'categorieclient_id' => ['type' => Type::int(), 'description' => ''],
                'clienttypeclients' => ['type' => Type::listOf(GraphQL::type('Clienttypeclient')), 'description' => ''],
                'categorieclient' => ['type' => GraphQL::type('Categorieclient'), 'description' => ''],
                'user' => ['type' => GraphQL::type('User'), 'description' => ''],
                'user_id' => ['type' => Type::int(), 'description' => ''],
                'axe' => ['type' => GraphQL::type('Axe'), 'description' => ''],
                'axe_id' => ['type' => Type::int(), 'description' => ''],
                'created_at' => ['type' => Type::string(), 'description' => ''],
                'created_at_fr' => ['type' => Type::string(), 'description' => ''],
                'updated_at' => ['type' => Type::string(), 'description' => ''],
                'updated_at_fr' => ['type' => Type::string(), 'description' => ''],
                'deleted_at' => ['type' => Type::string(), 'description' => ''],
                'deleted_at_fr' => ['type' => Type::string(), 'description' => ''],
            ];
    }


    protected function resolveUserField($root, $args)
    {
        return Client::find($root["id"])->user;
    }
}
