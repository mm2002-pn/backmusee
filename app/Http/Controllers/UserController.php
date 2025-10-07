<?php

namespace App\Http\Controllers;

use App\Jobs\ImportUserFilejob;
use App\Models\Fournisseur;
use App\Models\Historiqueaffectation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Outil;
use App\Models\Userzone;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class UserController extends SaveModelController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Authenticatable, HasApiTokens, ResponseTrait;

    protected $queryName = "users";
    protected $model = User::class;
    protected $job = ImportUserFilejob::class;



    public function inscription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name,' . ($request->id ?? 'NULL') . ',id',
            'email' => 'required|email|unique:users,email,' . ($request->id ?? 'NULL') . ',id',
            'login' => 'required|unique:users,login,' . ($request->id ?? 'NULL') . ',id',
            'password' => [
                'nullable',
                'confirmed',
                function ($attribute, $value, $fail) use ($request) {
                    if (empty($request->id) && empty($value)) {
                        $fail("Veuillez définir un mot de passe.");
                    }
                },
            ],
            'role' => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors(), 422);
        }

        try {
            return DB::transaction(function () use ($request) {

                $item = isset($request->id) && is_numeric($request->id) && $request->id > 0
                    ? User::find($request->id)
                    : new User();

                if (!$item && isset($request->id)) {
                    return $this->sendError("Le user que vous tentez de modifier n'existe pas");
                }



                $zones = isset($request->zones) &&  count($request->zones) > 0 ?  $request->zones : null;



                $item->role_id = $request->role ?? null;
                $item->login = $request->login ?? null;
                $item->email = $request->email ?? null;
                $item->name = $request->name ?? null;
                $item->password = isset($request->password) && !empty($request->password) ?  bcrypt($request->password) : $item->password;
                $item->telephone = $request->telephone ?? null;
                $item->active =  1;
                $item->fournisseur_id =  $request->fournisseur;
                $item->save();


                if (!$item->save()) {
                    throw new Exception("Erreur lors de l'enregistrement de l'utilisateur ");
                }


                return Outil::redirectgraphql($this->queryName, "id:{$item->id}", Outil::$queries[$this->queryName]);
            });
        } catch (\Exception $e) {
            return Outil::getResponseError($e);
        }
    }


    public function login(Request $request)
    {
        // dd($request->all());
        $utilisateurDonnee = $request->validate([
            "login" => ["required", "string"],
            "password" => ["required", "string", "min:1", "max:30"]
        ]);
        $utilisateur = User::with('role')->where("login", $utilisateurDonnee['login'])->first();
        if (!$utilisateur) return response(["message" => "Aucun utilisateur de trouvé avec ce login : " . $utilisateurDonnee['login'] . " "], 401);
        $isMobile = $utilisateur->role->auth_mobile;
        if (!$isMobile || $isMobile != 1) {
            return response(["message" => "Vous n'etes pas autorisé à vous connecter sur cette application mobile"], 401);
        }
        // auth_mobile
        if (!Hash::check($utilisateurDonnee['password'], $utilisateur->password)) {
            return response(["message" => "Aucun utilisateur de trouvé avec ce mot de passe "], 401);
        }


        $token = $utilisateur->createToken("CLE_SECRETE")->plainTextToken;
        return response([
            "utilisateur" => $utilisateur,
            "token" => $token,
            'token_type' => 'Bearer',
        ], 200);
    }



    public function saveToken(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                if (isset($request) && isset($request->user_id)) {
                    $item         = User::find($request->user_id);
                    $item->token  = $request->token;

                    $item->save();

                    $retour = array(
                        "dataone" => $item,
                        "success" => "Token mis a jour",
                    );
                } else {
                    $retour = array(
                        "dataone" => null,
                        "error" => 'L\'utilisateur que vous tentez de modifier n\'existe pas',
                    );
                }

                return $retour;
            });
        } catch (\Exception $e) {
            return response()->json(array(
                'errors'          => config('app.debug') ? $e->getMessage() : Outil::getMsgError(),
                'errors_debug'    => [$e->getMessage()],
            ));
        }
    }

    public function usersage(){
        $users = Outil::user_Sage();

        if($users && count($users) > 0){
            $role = Role::whereRaw('LOWER(name) = ?', 'non defini')->first();
            foreach ($users as $key=>$user)
            {
                if(isset($user) && isset($role))
                {
                    $item= User::where('login',$user['LOGIN_0'])->first();
                    $password = 'passer';

                    if(!$item){
                        $item              = new User();
                    }

                   // $email = str_replace(' ', '', $user['MAIL_0']);

                    //$users = User::where('email',$user['MAIL_0'])->get();

                    $item->role_id = $role->id ?? null;
                    $item->login = $user['LOGIN_0'] ?? null;
                    $item->email = !empty($email) ? $email : $user['NOM_0'];
                    $item->name = $user['NOM_0'] ?? null;
                    $item->code = $user['CODE_0'] ?? null;
                    $item->CATUSR_0 = $user['CATUSR_0'] ?? null;
                    $item->password = isset($password) && !empty($password) ?  bcrypt($password) : $item->password;
                    $item->telephone = '';
                    $item->active =  1;

                    $item->save();

                }
            }
        }

        return $users;
    }
}
