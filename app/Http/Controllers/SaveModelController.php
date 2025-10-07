<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Jobs\ImportUserJob;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\{Jobs\ImportClientFileJob, Models\Outil};
use App\Enums\Annexe;
use App\Models\Bl;
use App\Models\Da;
use App\Models\Dadocumentspecification;
use App\Models\Demande;
use App\Models\Detailbl;
use App\Models\Detaillivraison;
use App\Models\Detailmateriel;
use App\Models\Pointdevente;
use App\Models\Visite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SaveModelController extends Controller
{
    protected $queryName;
    protected $model;
    protected $job;



    public function delete($id)
    {
        $retour = Outil::supprimerElement($this->model, $id);
        return $retour;
    }

    public function uploaddocument(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer', // ID de l'enregistrement
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error', $validator->errors(), 422);
            }

            Log::info("Données reçues", ['data' => $request->all()]);
            $model = app($this->model);
            $id = $request->id;
            $champ = $request->champ ?? '';

            if ($champ === "null" || $champ === null) {
                $champ = null;
            }

            // Charger le modèle
            $item = $model::find($id);

            if (!$item) {
                Log::info("Item non trouvé", ['id' => $id]);
                return $this->sendError('Non trouvé', ['id' => 'L\'enregistrement spécifié n\'existe pas'], 404);
            }



            // Déterminer le dossier de destination basé sur le type et le champ
            $dossier = "uploads/" . $request->model;
            Log::info("Dossier de destination", ['dossier' => $dossier]);
            // dd($request->all());
            // Téléchargement du fichier
            if ($request->hasFile('file')) {
                Log::info("Fichier reçu", ['file' => $request->file('file')->getClientOriginalName()]);
                $uploadedFile = Outil::uploadFile($request->file('file'), $dossier);

                if ($uploadedFile) {
                    Log::info("Fichier uploadé", ['upload' => $uploadedFile]);

                    if (isset($request->type) && $request->type === "dadocument") {
                        $da = Da::find($item->id);
                        $dadocument = new Dadocumentspecification();
                        $dadocument->da_id = $da->id;
                        $dadocument->designation = $request->designation ?? $uploadedFile['filename'];
                        $dadocument->date = Carbon::now()->format('Y-m-d');
                        $dadocument->isannexe = Annexe::NON;
                        $dadocument->url = $uploadedFile['pathtocall'];
                        $dadocument->save();

                        Log::info("DA document sauvegardé", ['dadocument' => $dadocument]);
                    } else {
                        // Vérifier que le champ existe dans le modèle
                        if (!$champ && !array_key_exists($champ, $item->getAttributes())) {
                            return $this->sendError('Champ non valide', ['champ' => 'Le champ spécifié n\'existe pas dans ce modèle'], 400);
                        }
                        $item->$champ = $uploadedFile['pathtocall'];
                        $response = $item->save();
                        Log::info("Item mis à jour", ['item' => $item]);
                    }

                    if (isset($response) && $response) {
                        if (isset($request->contrat) && $request->contrat == "iscontrat") {
                            $item->iscontrat = 1;
                            $item->nomcontrat = $request->nomcontrat ?? $uploadedFile['filename'];
                            $item->datecontrat = Carbon::now()->format('Y-m-d');
                            $item->save();
                            Log::info("Contrat sauvegardé", ['item' => $item]);
                        }
                    }

                    return $this->sendResponse([
                        'url' => $uploadedFile['pathtocall'],
                        'message' => 'Fichier uploadé avec succès'
                    ], 'Upload réussi');
                } else {
                    return $this->sendError('Erreur upload', 'Le fichier n\'a pas pu être uploadé', 500);
                }
            } elseif (isset($request->type) && $request->type === "daannexe") {
                $da = Da::find($item->id);
                $daannexe = new Dadocumentspecification();
                $daannexe->da_id = $da->id;
                $daannexe->documentspecification_id = $request->annexespecification_id ?? null;
                $daannexe->isannexe = Annexe::OUI;
                $daannexe->date = Carbon::now()->format('Y-m-d');
                $daannexe->save();

                Log::info("DA annexe sauvegardée", ['daannexe' => $daannexe]);
            }

            return Outil::redirectgraphql($this->queryName, "id:{$item->id}", Outil::$queries[$this->queryName]);
        } catch (\Exception $e) {
            Log::error("Erreur upload", ['exception' => $e->getMessage()]);
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }

    // ----------------------------------------------------------------

    public function status(Request $request)
    {
        $errors = null;
        $data = 0;

        try {
            // dd($request->all());
            // Vérification de la présence de `id` dans la requête
            if (isset($request->id) && !empty($request->id)) {
                // dd($request->all());

                // Si un seul `id` est fourni, on change le statut pour cet `id`
                $reponse = Outil::changeStatus(app($this->model), $request->id, $request->champ, $request->status);
                $data = $request->id;
            } else {
                $ids = $request->ids ?? [];
                // Changer le statut pour chaque `id`
                foreach ($ids as $id) {
                    $reponse = Outil::changeStatus(app($this->model), $id, $request->champ, $request->status);
                }
            }

            // Retourner la réponse
            if ($reponse) {
                $data = 1;
            } else {
                $errors = "Erreur lors de la modification du status";
            }
        } catch (\Exception $e) {
            // Capturer les exceptions et les retourner comme réponse d'erreur
            return Outil::getResponseError($e);
        }

        // Retourner la réponse au format JSON
        return response()->json([
            "data" => $data,
            "message" => "CHANGEMENT",
            "error" => $errors
        ]);
    }

    public static  function generateUniqueCode($prefix = 'FACT')
    {
        // Récupérer le dernier ID dans la table `Bl` (ou utiliser une logique alternative)
        $lastId = Bl::max('id') ?? 0;

        // Générer le prochain code basé sur l'ID
        $uniqueNumber = $lastId + 1;

        // Retourner le code avec un format sécurisé
        return sprintf('%s%08d', $prefix, $uniqueNumber); // Exemple : FACT00000001
    }


    public function statut(Request $request)
    {
        $errors = null;
        $data = 0;
        $reponse = false;
        // dd($request);
        try {

            if (isset($request->ids) && count($request->ids) > 0) {
                $ids = $request->ids;
                if (isset($request->ids[0]['commercial_id'])) {
                    $ids = array_column($request->ids, 'id');
                }
                $list = array_filter($request->ids, function ($item) {
                    return $item['etatquantite'] == 0;
                });
                // dd($list,$request->all());

                if (isset($request->ids[0]['commercial_id']) && count($list) > 0) {
                    $params = isset($request->params) ? explode(',', $request->params[0]) : [];

                    $datedeb = Outil::getAttributeValueFromArray($params, 'date');
                    $datefin = Outil::getAttributeValueFromArray($params, 'datefin') ?? $datedeb; // Par défaut, datefin = datedeb
                    // dd($datefin, $datedeb);
                    $commercial_id = Outil::getAttributeValueFromArray($params, 'commercial_id');

                    // Vérification de l'existence d'un BL sur la même période
                    $existingBl = Bl::where('commercial_id', $commercial_id)
                        ->where(function ($query) use ($datedeb, $datefin) {
                            if ($datedeb && $datefin) {
                                $query->whereBetween('datedebutperiode', [$datedeb, $datefin])
                                    ->orWhereBetween('datefinperiode', [$datedeb, $datefin])
                                    ->orWhere(function ($q) use ($datedeb, $datefin) {
                                        $q->where('datedebutperiode', '<=', $datedeb)
                                            ->where('datefinperiode', '>=', $datefin);
                                    });
                            }
                        })
                        ->first();


                    $bl = $existingBl ?? new Bl();
                    $bl->date = now();
                    $bl->issend = 0;
                    $bl->datedebutperiode = $datedeb;
                    $bl->datefinperiode = $datefin;
                    $bl->commercial_id = $bl->commercial_id ?? ($commercial_id ?? null);

                    if (!$existingBl) {
                        $bl->code = self::generateUniqueCode('FACT');
                    }

                    $bl->save();

                    // Sauvegarde des détails des livraisons
                    $this->saveLivraisonDetails($list, $bl);
                    $reponse = true;
                }

                foreach ($ids as $id) {
                    $reponse = Outil::changeStatus(app($this->model), $id, $request->attr, $request->value);
                }
            }


            if (isset($request->data)) {
                $dataDecode = json_decode($request->data);
                $chaine = "App\Models\\" . $dataDecode->model;
                $model = new $chaine();
                $item = $model->findOrFail(intval($dataDecode->id));
                $item->quantite = $dataDecode->quantite;
                $dataDecode->model == "Detaillivraison" ? $item->produit_id = $dataDecode->produit_id : $item->equipement_id = $dataDecode->equipement_id;
                $item->save();
                $reponse = true;
            }

            // Retourner la réponse
            if ($reponse) {
                $data = 1;
            } else {
                $errors = "Erreur lors de la modification du status";
            }
        } catch (\Exception $e) {
            dd($e);
            // Capturer les exceptions et les retourner comme réponse d'erreur
            return Outil::getResponseError($e);
        }

        // Retourner la réponse au format JSON
        return response()->json([
            "data" => $data,
            "message" => "CHANGEMENT",
            "error" => $errors
        ]);
    }




    /**
     * Sauvegarde les détails des livraisons dans `Detailbl`.
     */
    /**
     * Sauvegarde les détails des livraisons dans `Detailbl`.
     * Si le même produit existe déjà pour le même point de vente, on cumule la quantité.
     */
    private function saveLivraisonDetails($ids, $bl)
    {
        foreach ($ids as $detaillivraison) {
            foreach ($detaillivraison["detaillivraisons"] as $detail) {
                // dd($detail);
                $produit_id = $detail['produit_id'];
                $pointdevente_id = $detaillivraison['pointdevente_id'];
                $quantite = intval($detail['quantite']); // Assurer que c'est bien un entier

                // Vérifier si une entrée existe déjà
                $existingDetail = Detailbl::where('bl_id', $bl->id)
                    ->where('produit_id', $produit_id)
                    ->where('pointdevente_id', $pointdevente_id)
                    ->first();
                // dd($existingDetail);
                if ($existingDetail) {
                    Log::info("Avant modification    : ID={$existingDetail->id}, Quantité={$existingDetail->quantite}");

                    // Mise à jour de la quantité
                    $existingDetail->increment('quantite', $quantite);

                    Log::info("Après modification  : ID={$existingDetail->id}, Nouvelle Quantité={$existingDetail->quantite}");
                } else {
                    // Création d'une nouvelle ligne si le produit n'existe pas encore
                    Detailbl::create([
                        'bl_id' => $bl->id,
                        'produit_id' => $produit_id,
                        'pointdevente_id' => $pointdevente_id,
                        'quantite' => $quantite,
                    ]);
                }
            }
        }
    }


    /**
     * Crée une nouvelle demande si des paramètres sont fournis.
     */
    private function createDemande($param, $commercial_id, $pointdevente_id)
    {
        $demande = new Demande();
        $demande->date = now();
        $demande->etat = 2;
        $demande->commercial_id = $commercial_id ?? null;
        $demande->pointdevente_id = $pointdevente_id ?? null;
        $demande->save();

        // Sauvegarder les détails du matériel
        foreach ($param as $detailmateriel) {
            if (isset($detailmateriel['type']) && $detailmateriel['type'] == 2) {
                // C'est une demande de matériel
                $detail = Detailmateriel::find($detailmateriel['id']);
                $detail->demande_id = $demande->id;
                $detail->save();
            }
        }
    }





    public function sendNotifImport($userId, $filename)
    {
        $extension = pathinfo($filename->getClientOriginalName(), PATHINFO_EXTENSION);

        //dd($filename);

        $queryName = Outil::getQueryNameOfModel(app($this->model)->getTable());
        $generateLink = substr($queryName, 0, (strlen($queryName) - 1));
        // ENVOIE DE LA NOTIFICATION DE DEBUT



        // //$eventNotif = new SendNotifEvent($notifPermUser);
        // //event($eventNotif);

        // $from  = public_path('uploads') . "/{$queryName}/{$userId}/";
        // $to    = "upload.{$extension}";
        // $file  = $filename->move($from, $to);

        // //$this->dispatch((new $this->job($this->model, $generateLink, $file, $userId, $from . $to)));
        // (new ImportClientFileJob($this->model, $generateLink, $file, $userId, $from . $to));
        // //Excel::queueImport(new ImportClientFileJob($this->model, $generateLink, $file, $userId, $from . $to), $file, null, \Maatwebsite\Excel\Excel::XLSX);


    }


    public function import(Request $request)
    {
        try {

            // Vérifiez si un fichier Excel a été téléchargé
            if (!$request->hasFile('file')) {
                throw new \Exception('Un fichier Excel est requis');
            }

            $filename = $request->file('file');
            $extension = pathinfo($filename->getClientOriginalName(), PATHINFO_EXTENSION);

            // Vérifiez si le fichier est au format Excel (xlsx, xls, csv)
            if (!in_array($extension, ['xlsx', 'xls', 'csv'])) {
                throw new \Exception("Le fichier doit être de type Excel (xlsx, xls, csv)");
            }

            $data = Excel::toArray(null, $filename, null, \Maatwebsite\Excel\Excel::XLSX);
            $data = $data[0]; // Première feuille du classeur Excel
            array_shift($data); // Supprimer l'entête
            // dd($data);

            // Vérifiez si le fichier contient des données
            if (count($data) < 2) {
                throw new \Exception("Le fichier ne doit pas être vide");
            }

            // Obtenez le nom de la classe d'importation en fonction du modèle
            $importClass = $this->getImportClass();

            // dd($importClass);
            // Vérifiez si le fichier est en cours d'upload
            $userId = 1; // Remplacez ceci par la logique pour obtenir l'ID de l'utilisateur
            $uploadFilePath = public_path('uploads') . "/" . Outil::getQueryNameOfModel(app($this->model)->getTable()) . "/{$userId}/upload.{$extension}";
            if (file_exists($uploadFilePath)) {
                throw new \Exception("Un fichier est déjà en cours d'upload, merci de patienter, la fin de celui-ci $uploadFilePath");
            }

            // Importez les données en utilisant la classe d'importation obtenue
            $response =    Excel::import(new $importClass, $filename);
            // Renvoyer une réponse JSON
            return response()->json([
                "data" => 1,
                "message" => "Importation réussie."
            ]);
        } catch (\Exception $e) {
            return Outil::getResponseError($e);
        }
    }

    protected function getImportClass()
    {
        // Obtenez le nom de la classe du modèle
        $modelClassName = class_basename(app($this->model));

        $importClassName = "App\\Imports\\{$modelClassName}sImport";

        if (!class_exists($importClassName)) {
            throw new \Exception("La classe d'importation $importClassName n'existe pas");
        }

        return $importClassName;
    }



    public function importJob(Request $request)
    {
        try {

            $errors = null;
            $data = 0;
            if (!isset($this->job)) {
                $errors = "L'import sur ce type de donnée n'a pas été configuré dans le système";
            } else {
                if (empty($request->file('file'))) {
                    $errors = 'Un fichier Excel est requis';
                }
                if ($request->hasFile('file')) {
                    $filename = request()->file('file');
                    $extension = pathinfo($filename->getClientOriginalName(), PATHINFO_EXTENSION);
                    if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                        $data = Excel::toArray(null, $filename);
                        $data = $data[0]; // 0 => à la feuille 1
                        // dd($data) ;
                        if (count($data) < 2) {
                            $errors = "Le fichier ne doit pas être vide";
                        } else {
                            //$userId = Auth::user()->id;
                            $userId = 1;
                            //   dd($this->model);
                            if (file_exists(public_path('uploads') . "/" . Outil::getQueryNameOfModel(app($this->model)->getTable()) . "/{$userId}/upload.{$extension}")) {
                                $errors = "Un fichier est déjà en cours d'upload, merci de patienter, la fin de celui-ci";
                            } else {
                                // dd('dans le job');
                                // $errors ="Upload reussi";

                                $this->sendNotifImport($userId, $filename);
                            }
                        }
                    } else {
                        $errors = "Le fichier doit être de type Excel";
                    }
                }
            }

            if (isset($errors)) {
                throw new \Exception($errors);
            }
            $type = Outil::getQueryNameOfModel(app($this->model)->getTable());
            if ($type) {
                $data = 1;
            }


            return response()->json(
                array(
                    "data" => $data,
                    //"message" => "Le fichier est en cours de traitement..."
                    "message" => "Importation reussie."
                )
            );
            //});
        } catch (\Exception $e) {
            return Outil::getResponseError($e);
        }
    }


    // public function import(Request $request)
    // {
    //     request()->validate([
    //         'file' => 'required'
    //     ]);

    //     return response()->json(array(
    //         "data" => 1,
    //         "message" => "Importation reussie."
    //     ));
    // }

    function validateObject($request, $class, $columnName)
    {
        $columnName = strtolower($columnName);

        if (empty($request->$columnName)) {
            return "Veuillez renseigner $columnName";
        } else {
            $model = new $class(); // Créer une instance du modèle Eloquent
            $item = $model->find(intval($request->$columnName));

            if (!$item) {
                return "$columnName spécifié n'existe pas";
            }

            return $item;
        }

        return null; // Si tout est valide
    }
}
