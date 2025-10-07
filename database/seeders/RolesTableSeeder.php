<?php

namespace Database\Seeders;

use App\Http\Controllers\RoleController;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Outil;
use App\Models\Typeencaissement;
use App\Models\Permission;

use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Création des rôles de base
        $roles = [
            [
                "designation" => "S.AD",
                "name" => "super-admin",
                "description" => "Super Administrateur avec tous les droits",
                "notifsuper" => 0,
                "viewdemande" => 3,
                "isadmin" => 1,
                "estautoriser" => 1,
            ]
        ];

        foreach ($roles as $item) {
            $newitem = Role::where([['name', Outil::getOperateurLikeDB(), '%' . $item['name'] . '%']])->first();
            if (!isset($newitem)) {
                $newitem = new Role();
            }
            $newitem->designation = $item['designation'];
            $newitem->name = $item['name'];
            $newitem->description = $item['description'];
            $newitem->isadmin = $item['isadmin'];
            $newitem->estautoriser = $item['estautoriser'];
            $newitem->save();

            if ($newitem->name === 'super-admin') {
                $permissions = Permission::all()->pluck('id')->toArray();
                $newitem->permissions()->sync($permissions);
            }
        }
    }
}
