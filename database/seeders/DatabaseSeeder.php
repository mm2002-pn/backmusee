<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Models\Planning;
use App\Models\Planningzone;
use App\Models\Voiture;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Symfony\Component\VarDumper\Cloner\Data;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            // DataSeeder::class,
            UsersSeeder::class,
            //AoSeeder::class
        ]);
    }
}
