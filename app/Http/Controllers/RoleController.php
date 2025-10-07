<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Models\Outil;
use App\Models\Permission;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    use ResponseTrait;
    protected $queryName = "roles";
    protected $model = Role::class;

    public function save(Request $request)
    {
        // dd($request->all());

        if ($request->permission && is_string($request->permission)) {
            $request->merge([
                'permission' => json_decode($request->permission, true)
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . ($request->id ?? 'NULL') . ',id',
            'permission' => 'nullable|array',
            'permission.*' => 'exists:permissions,id',
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors(), 422);
        }

        try {
            return DB::transaction(function () use ($request) {

                $item = isset($request->id) && is_numeric($request->id) && $request->id > 0
                    ? Role::find($request->id)
                    : new Role();


                if (!$item && isset($request->id)) {
                    return $this->sendError("Le rôle que vous tentez de modifier n'existe pas");
                }


                $item->name = isset($request->nouveauname) && !empty($request->nouveauname)
                    ? $request->nouveauname
                    : $request->name;




                $item->designation = $request->designation;
                $item->description = $request->description;
                // $item->iscommercial = isset($request->iscommercial) ? $request->iscommercial : 0;
                // $item->isplanning = isset($request->isplanning) ? $request->isplanning : 0;
                // $item->ischauffeur = isset($request->ischauffeur) ? $request->ischauffeur : 0;
                $item->isadmin = isset($request->isadmin) ? $request->isadmin : 0;
                // $item->estautoriser = isset($request->estautoriser) ? $request->estautoriser : 0;
                // $item->auth_mobile = isset($request->auth_mobile) ? $request->auth_mobile : 0;
                // $item->ischantenne = $request->ischantenne ?? null;

                $item->save();

                if (!$item->save()) {
                    throw new Exception("Erreur lors de l'enregistrement du produit");
                }


                $role_permissions = $request->permission ?? [];

                self::syncPermissions($item, $role_permissions);


                return Outil::redirectgraphql($this->queryName, "id:{$item->id}", Outil::$queries[$this->queryName]);
            });
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }


    public static function getStoredPermission($permissionId)
    {
        return Permission::find($permissionId);
    }


    public static function syncPermissions($role, $permissions)
    {
        $role->permissions()->detach();
        if (count($permissions) > 0) {
            $permissionIds = collect($permissions)
                ->flatten()
                ->map(function ($permission) {
                    if (empty($permission)) {
                        return null;
                    }
                    return self::getStoredPermission($permission);
                })
                ->filter()
                ->pluck('id')
                ->all();
            $role->permissions()->sync($permissionIds);
        }
    }


    public function delete($id)
    {
        try {
            return DB::transaction(function () use ($id) {
                $errors = null;
                $data = 0;
                if ($id) {
                    $role = Role::find($id);
                    if ($role) {
                        if (count($role->users) > 0) {
                            $data = 0;
                            $errors = "Cet profil est lié a des utilisateurs";
                        } else {
                            $role->delete();
                            $role->forceDelete();

                            $data = 1;
                        }
                    } else {
                        $data = 0;
                        $errors = "Cet profil est inexistant";
                    }
                } else {
                    $errors = "Données manquantes";
                }

                if (isset($errors)) {
                    throw new \Exception($errors);
                } else {
                    $retour = array(
                        'data' => $data,
                    );
                }
                return response()->json($retour);
            });
        } catch (\Exception $e) {
            return Outil::getResponseError($e);
        }
    }
}
