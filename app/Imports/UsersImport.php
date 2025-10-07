<?php

namespace App\Imports;

use App\Models\Antenne;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

use function GuzzleHttp\Psr7\str;

class UsersImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rows->shift(1); // Supprimer l'en-tête

        foreach ($rows as $row) {
            // dd($row);
            $nom = str_replace(' ', '', trim($row[1]));
            $prenom = str_replace(' ', '', trim($row[2]));
            $nomXprenom = strtolower($nom . $prenom);

            $email = strtolower($nomXprenom . '@yellitaare.sn');
            $mdp = Hash::make('123');
            $code = $row[0] ?? null;
            $cptclient = $row[6] ?? null;

            // Vérification par email, login ou nom
            $user = User::where('email', $email)
                ->orWhere('login', $nomXprenom)
                ->orWhere('name', $nomXprenom)
                ->first();

            if ($user) {
                $user->update([
                    'name' => $nom . ' ' . $prenom,
                    'email' => $email,
                    'password' => $mdp,
                    'login' => $nomXprenom,
                    'code' => $code,
                    'compteclient' => $cptclient,
                    'image' => 'assets/images/logo-icon.png',
                    'active' => 1,
                ]);
            } else {
                $user = User::create([
                    'name' => $nom . ' ' . $prenom,
                    'email' => $email,
                    'password' => $mdp,
                    'login' => $nomXprenom,
                    'code' => $code,
                    'compteclient' => $cptclient,
                    'image' => 'assets/images/logo-icon.png',
                    'active' => 1,
                ]);
            }



            // Traitement du rôle
            $antenne = strtolower(trim($row[4] ?? ''));
            $codeantenne = $row[5] ?? null;
            $anten = Antenne::whereRaw('LOWER(designation) = ?', [$antenne])->first();

            if (!$anten) {
                $anten = Antenne::create([
                    'designation' => $antenne,
                    'code' => $codeantenne,
                ]);
            }

            if ($anten) {
                $user->antenne_id = $anten->id;
            }




            // Traitement du rôle
            $roleName = strtolower(trim($row[3] ?? ''));
            $role = Role::whereRaw('LOWER(name) = ?', [$roleName])->first();

            if (!$role) {
                $role = Role::create([
                    'name' => $roleName,
                    'isplanning' => 0,
                    'iscommercial' => 0,
                ]);
            }

            if ($role) {
                $user->role_id = $role->id;
            }

            // Enregistrer l'utilisateur dans la base de données
            $user->save();
        }
    }
}
