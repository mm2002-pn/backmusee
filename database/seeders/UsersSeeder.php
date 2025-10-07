<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Departement;
use App\Models\User;
use App\Models\Role;
use App\Models\Outil;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = array();
        array_push(
            $items,
            array(
                "login" => "htsoft2024",
                "email" => "htsoft@root.com",
                'password' => bcrypt('123'),
                "name" => "HTSOFT",
                "role" => "super-admin",
            )
        );

        foreach ($items as $item) {
            // Modification clé ici: utilisation de where avec '=' au lieu de LIKE
            $newitem = User::where('login', $item['login'])
                ->orWhere('email', $item['email'])
                ->first();

            if (!$newitem) {
                $newitem = new User();
                $newitem->login = $item['login'];
                $newitem->email = $item['email'];
                $newitem->password = $item['password'];
                $newitem->name = $item['name'];

                $role = Role::where('name', $item['role'])->first();

                if ($role) {
                    $newitem->role_id = $role->id;
                }

                $newitem->save();
            } else {
                // Mise à jour de l'utilisateur existant si nécessaire
                $newitem->password = $item['password'];
                $newitem->name = $item['name'];

                $role = Role::where('name', $item['role'])->first();

                if ($role) {
                    $newitem->role_id = $role->id;
                }

                $newitem->save();
            }
        }


        $items = array();
        array_push(
            $items,
            array(
                "code" => "1",
                "designation" => "AMI",
                'description' => "AMI"
            )
        );
    }
}
