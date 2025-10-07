<?php

namespace App\Jobs;

use App\Models\Outil;
use App\Models\Role;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ImportUserFilejob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $file;

    /**
     * @var string
     */
    private $pathFile;

    /**
     * @var string
     */
    private $generateLink;

    /**
     * @var Model
     */
    private $model;

    /**
     * @var User
     */
    private $user;
    private $userId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($model, $generateLink, string $file, $userId, $pathFile)
    {
        $this->model = $model;
        $this->generateLink = $generateLink;
        $this->file = $file;
        $this->userId = $userId;
        $this->pathFile = $pathFile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Outil::setParametersExecution();
        try {
            $this->user = User::find($this->userId);

            $filename = $this->file;
            $data = Excel::toArray(null, $filename);
            $data = $data[0]; // 0 => à la feuille 1
            // dd($data);
            $report = array();

            $totalToUpload = count($data) - 1;
            $totalUpload = 0;
            $lastItem = null;
            DB::transaction(function () use (&$totalUpload, &$data, &$report, &$lastItem) {
                for ($i = 1; $i < count($data); $i++) {
                    $errors = null;
                    $is_save = 0;
                    $row = $data[$i];
                    $default_image = 'assets/images/logo-icon.png';
                    try {
                        $nomXpronom = trim($row[0]);
                        $roleName = trim($row[1]);
                    } catch (\Exception $e) {
                        $errors = "verifier bien les intitules";
                        array_push($report, [
                            'ligne'             => ($i),
                            'libelle'           => "Users",
                            'erreur'            => $errors,
                            'is_save'           => $is_save,
                        ]);
                        break;
                    }

                    $nomXpronom ?: $errors = "Veuillez definir le nom de l'utilisateur";
                    $roleName ?: $errors = "Veuillez definir le role du client";

                    // Vérification du client et de la zone
                    $newrole = Role::where('name', $roleName)->first();
                    $email = str_replace(' ', '', $nomXpronom) . '@delice.sn';
                    $newUser = User::where('email', strtolower($email))->first();

                    if (!$errors) {

                        // ajoute la zone si inexistante ou recupere l'id si la zone est existante
                        if (!isset($newrole)) {

                            $newrole = new Role();
                            $newrole->name = $roleName;

                            if (stripos(strtolower($roleName), 'directeur') !== false || stripos(strtolower($roleName), 'directrice') !== false || stripos(strtolower($roleName), 'responsable') !== false) {
                                $newrole->isplanning = 0;
                            } else {
                                $newrole->isplanning = 1;
                            }
                            if (strtolower($roleName) == strtolower('commercial')) {
                                $newrole->iscommercial = 1;
                            } else {
                                $newrole->iscommercial = 0;
                            }

                            $isRolesaved = $newrole->save();
                        } else {
                            $isRolesaved = true;
                        }


                        if ($isRolesaved) {

                            $totalUpload++;
                            // modifie ou ajoute l'utilisateur
                            if (!isset($newUser)) {
                                $newUser = new User();
                            }
                            $newUser->email = strtolower($email);
                            $newUser->name = $nomXpronom;
                            $newUser->password = bcrypt('passer123');
                            $newUser->login = str_replace(' ', '', $nomXpronom);
                            $newUser->image = $default_image;
                            $newUser->role_id = $newrole->id;
                            $newUser->active = 1;
                            $isUsersaved = $newUser->save();
                        }

                        $lastItem = $newUser;
                    }


                    if (!empty($nomXpronom) && !$isUsersaved) {
                        array_push($report, [
                            'ligne'             => ($i + 1),
                            'libelle'           => $nomXpronom,
                            'erreur'            => $errors,
                            'is_save'           => $isUsersaved,
                        ]);
                    }
                }
            });

            Outil::atEndUploadData($this->pathFile, $this->generateLink, $report, $this->user, $totalToUpload, $totalUpload, "des utilisateurs", $lastItem);
        } catch (\Exception $e) {
            try {
                File::delete($this->pathFile);
            } catch (\Exception $eFile) {
                throw new \Exception($e->getMessage());
            };
            throw new \Exception($e->getMessage());
        }
    }
}
