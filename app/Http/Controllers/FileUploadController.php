<?php

namespace App\Http\Controllers;

use App\Models\Bl;
use App\Models\Outil;
use App\Models\Soumission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function uploadFileToFtp($filters = null)
    {
        // Récupération des données avec GraphQL
        $id = "id: " . $filters;
        $data = Outil::getAllItemsWithGraphQl("soumissions", $id);
        $params = "soumission_id:" . $filters . "," . "isselected:1";
        $dataSoumissionArticles = Outil::getAllItemsWithGraphQl("soumissionarticles", $params);
        // dd($data,$dataSoumissionArticles);
        // Vérifier si on a des données
        if (isset($data["data"]) && count($data["data"]) == 0) {
            return view('ftp.upload_status', [
                'status' => 'error',
                'message' => 'Aucune donnée à envoyer.'
            ]);
        }

        // Récupérer la soumission
        $soumission = $data[0];
        $fournisseur = $soumission['fournisseur'] ?? [];

        // Préparation de l'en-tête du fichier avec des points-virgules
        $header = "";

        // Préparation du contenu du fichier
        $fileContent = $header;

        // Valeurs fixes pour l'exemple (à adapter selon vos besoins)
        $siteCommande = "SIE1";
        $numCommande = "";
        $devise = "MGA";
        $regimeTaxe = "TTC";
        $conditionPaiement = "VIR60";
        $intersite = "1";
        $typePassationMarche = "3";
        $noMarche = "AON-2509-8744";
        $commentaire = "test commentaire";
        $preparateur = "ACHE";
        $acheteur = "ACHE";
        $transporteur = "";
        $transitaire = "";
        $siteReception = "MC01";

        // Date de la soumission au format DDMMYYYY
        $dateSoumission = !empty($soumission['date']) ? date('dmY', strtotime($soumission['date'])) : date('dmY');

        // Code fournisseur
        $codeFournisseur = $fournisseur['code'] ?? "-----";

        // Référence commande
        $refCommande = "DA" . str_pad($soumission['id'], 5, '0', STR_PAD_LEFT);

        // Parcourir les articles sélectionnés
        foreach ($dataSoumissionArticles as $article) {
            $articleData = $article['article'] ?? [];
            $fabricant = $article['fabricant'] ?? [];

            // Référence article
            $refArticle = $articleData['code'] ?? "ART" . $articleData['id'];

            // Désignation
            $designation = $articleData['designation'] ?? "-----";

            // Unité
            $unite = $articleData['unite']['designation'] ?? "UN";

            // Quantité
            $quantite = $article['quantitepropose'] ?? 00;

            // Prix
            $prix = $article['prixunitairepropose'] ?? 00;
            $dateReception =  !empty($article['datelivraison']) ? date('dmY', strtotime($article['datelivraison'])) : date('dmY');

            // Construction de la ligne avec des points-virgules
            $line = implode(";", [
                $siteCommande,
                $numCommande,
                $dateSoumission,
                $codeFournisseur,
                $refCommande,
                $devise,
                $regimeTaxe,
                $conditionPaiement,
                $intersite,
                $typePassationMarche,
                $noMarche,
                $commentaire,
                $preparateur,
                $acheteur,
                $transporteur,
                $transitaire,
                $refArticle,
                $designation,
                $siteReception,
                $unite,
                $quantite,
                $dateReception,
                $prix
            ]) . PHP_EOL;

            $fileContent .= $line;
        }

        if ($fileContent === $header) {
            return view('ftp.upload_status', [
                'status' => 'error',
                'message' => 'Aucune donnée d\'article à envoyer.'
            ]);
        }

        // Génération du nom du fichier avec la date
        $fileName = 'commande_' . date('Y-m-d_H-i-s') . '.txt';
        Storage::put($fileName, $fileContent);

        if (!Storage::exists($fileName)) {
            return view('ftp.upload_status', [
                'status' => 'error',
                'message' => 'Le fichier n\'a pas pu être créé localement.'
            ]);
        }

        $filePath = Storage::path($fileName);
        $fileData = file_get_contents($filePath);

        $soumission = Soumission::find($filters);

        if ($soumission) {
            $soumission->isbc = 1;
            $soumission->save();
        }

        try {
            // Envoi du fichier sur le serveur FTP
            // Storage::disk('sftp')->put($fileName, $fileData);

            // Retourner une vue de succès
            // return view('ftp.upload_status', [
            //     'status' => 'success',
            //     'message' => 'Fichier envoyé avec succès au serveur FTP.',
            //     'fileName' => $fileName,
            //     'fileContent' => $fileContent // Optionnel: pour debugger
            // ]);
            // Retourner le fichier en téléchargement directement
            return response($fileContent)
                ->header('Content-Type', 'text/plain')
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        } catch (\Exception $e) {
            // En cas d'erreur, retourner une vue d'erreur
            return view('ftp.upload_status', [
                'status' => 'error',
                'message' => 'Erreur lors de l\'envoi sur le serveur FTP : ' . $e->getMessage()
            ]);
        }
    }
}
