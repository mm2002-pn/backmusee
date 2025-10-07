<?php

namespace App\Jobs;

use App\Models\Client;
use App\Models\Outil;
use App\Models\Pointdevente;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ImportClientFileJob implements ShouldQueue
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
        dd('I am here');
        try {
           $this->user = User::find($this->userId);

            $filename = $this->file;
            $data = Excel::toArray(null, $filename);
            $data = $data[0]; // 0 => à la feuille 1

            $report = array();

            $totalToUpload = count($data) - 1;
            $totalUpload = 0;
            $lastItem = null;
            DB::transaction(function () use (&$totalUpload, &$data, &$report, &$lastItem) {
                for ($i = 1; $i < count($data); $i++) {
                    $errors = null;
                    $is_save = 0;
                    $row = $data[$i];
                    try {
                        $cptTiers = trim($row[0]);
                        $intitule    = trim($row[1]);
                        $cptcollectif = trim($row[2]);
                        $zonename = trim($row[3]);
                    } catch (\Exception $e) {
                        $errors = "verifier bien les intitules";
                        array_push($report, [
                            'ligne'             => ($i),
                            'libelle'           => "Clients",
                            'erreur'            => $errors,
                            'is_save'           => $is_save,
                        ]);
                        break;
                    }

                    $intitule ?: $errors = "Veuillez definir l'intitule";
                    $cptTiers ?: $errors = "Veuillez definir le numero compte tier";
                    $cptcollectif ?: $errors = "Veuillez definir le numero compte collectif";
                    $zonename ?: $errors = "Veuillez definir la zone";


                    // Vérification du client et de la zone
                    $newclient = Client::where('numbcpttier', $cptTiers)->first();
                    $zone = Zone::where('designation', $zonename)->first();


                    if (!$errors) {
                        // ajoute la zone si inexistante ou recupere l'id si la zone est existante
                        if (!isset($zone)) {
                            $zone = new Zone();
                            $zone->designation = $zonename;
                            $isZonesaved = $zone->save();
                        } else {
                            $isZonesaved = true; // La zone existe déjà, pas besoin de sauvegarder à nouveau.
                        }
                    
                        // modifie ou ajoute le client
                        if (!isset($newclient)) {
                            $newclient = new Client();
                        }
                        $newclient->numbcpttier = $cptTiers;
                        $newclient->intitule = $intitule;
                        $newclient->cptcollectif = $cptcollectif;
                        $isClientsaved = $newclient->save();
                    
                        $lastItem = $newclient;
                    
                        if ($isClientsaved && $isZonesaved) {
                            $totalUpload++;
                            if ($newclient->wasRecentlyCreated) {
                                $pointdevente = new Pointdevente();
                                $pointdevente->client_id = $newclient->id;
                                $pointdevente->intitule = $newclient->intitule;
                                $pointdevente->numbcpttier = $newclient->numbcpttier;
                                $pointdevente->zone_id = $zone->id;
                                $pointdevente->save();
                            }
                        }
                    }


                    if (!empty($cptTiers) && !$isClientsaved) {
                        array_push($report, [
                            'ligne'             => ($i + 1),
                            'libelle'           => $cptTiers,
                            'erreur'            => $errors,
                            'is_save'           => $isClientsaved,
                        ]);
                    }
                }
            });

            Outil::atEndUploadData($this->pathFile, $this->generateLink, $report, $this->user, $totalToUpload, $totalUpload, "des clients", $lastItem);
        } catch (\Exception $e) {
            try {
                File::delete($this->pathFile);
            } catch (\Exception $eFile) {
            };
            throw new \Exception($e);
        }
    }
}
