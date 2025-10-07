<?php

namespace App\Imports;

use App\Models\Categorie;
use App\Models\Client;
use App\Models\Outil;
use App\Models\Pointdevente;
use App\Models\Produit;
use App\Models\Role;
use App\Models\Unite;
use App\Models\User;
use App\Models\Zone;
use App\Models\Zonepointdevente;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProduitsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rows->shift();

        // dd($rows);
        try {


            $cpt = 0;
            foreach ($rows as $row) {
                // dd($row);
                // $decouper = explode(",", $row[0]);
                // dd($decouper);

                $cpt++;
                // $code = trim($row[0]) ?? $decouper[0];
                // $img =  $decouper[1];
                // $designation = trim($row[1]) ?? $decouper[5];
                // $categorieexel = trim($row[2]) ?? $decouper[2];
                // $prix = trim($row[3]) ?? $decouper[13];
                $code = $row[0];
                $designation = $row[3];
                $categorieexel = $row[1];
                $prix = intval($row[8]);
                $unite_des = $row[6];

                /// dd($intitule, $intitule, $cptCollectif, $zoneName);
                // Vérification des données requises
                if (empty($code) || empty($designation) || empty($categorieexel)) {
                    throw new \Exception("Certaines données sont manquantes dans le fichier excel");
                }

                // Recherche de la zone associée
                $categorie = Categorie::where('designation', strtoupper($categorieexel))->first();

                if (!isset($categorie)) {
                    $categorie = new Categorie();
                    $categorie->designation = strtoupper($categorieexel);
                    $iscategoriesaved = $categorie->save();
                } else {
                    $iscategoriesaved = true;
                }

                $unite = Unite::where('designation', strtoupper($unite_des))->first();

                if (!isset($unite)) {
                    $unite = new Unite();
                    $unite->designation = strtoupper($unite_des);
                    $isunitesaved = $unite->save();
                } else {
                    $isunitesaved = true;
                }


                if ($iscategoriesaved) {

                    $produit = Produit::where('code', $code)->first();
                    if (!isset($produit)) {
                        $produit = new Produit();
                    }
                    $produit->code = $code;
                    $produit->designation = $designation;
                    $produit->categorie_id = $categorie->id;
                    $produit->prix = $prix;
                    $produit->unite_id = $unite->id;
                    $produit->isdisplay = 1;
                    $isProduitsaved = $produit->save();
                }

                if (!$isProduitsaved) {
                    throw new \Exception("Erreur lors de l'enregistrement du produit");
                }
            }
            if ($cpt >= $rows->count()) {
                return array(
                    "data" => 1
                );
            }

            // $cpt = 0;
            // foreach ($rows as $row) {
            //     // dd($row);
            //     $decouper = explode(",", $row[0]);
            //     // dd($decouper);

            //     $cpt++;
            //     // $code = trim($row[0]) ?? $decouper[0];
            //     // $img =  $decouper[1];
            //     // $designation = trim($row[1]) ?? $decouper[5];
            //     // $categorieexel = trim($row[2]) ?? $decouper[2];
            //     // $prix = trim($row[3]) ?? $decouper[13];
            //     $code = $decouper[0];
            //     $img =  $decouper[1];
            //     $designation = $decouper[5];
            //     $categorieexel = $decouper[2];
            //     $prix = $decouper[13];

            //     /// dd($intitule, $intitule, $cptCollectif, $zoneName);
            //     // Vérification des données requises
            //     if (empty($code) || empty($designation) || empty($categorieexel)) {
            //         throw new \Exception("Certaines données sont manquantes dans le fichier excel");
            //     }

            //     // Recherche de la zone associée
            //     $categorie = Categorie::where('designation', strtoupper($categorieexel))->first();

            //     if (!isset($categorie)) {
            //         $categorie = new Categorie();
            //         $categorie->designation = strtoupper($categorieexel);
            //         $iscategoriesaved = $categorie->save();
            //     } else {
            //         $iscategoriesaved = true;
            //     }
            //     if ($iscategoriesaved) {

            //         $produit = Produit::where('code', $code)->first();
            //         if (!isset($produit)) {
            //             $produit = new Produit();
            //         }
            //         $produit->code = $code;
            //         $produit->designation = $designation;
            //         $produit->categorie_id = $categorie->id;
            //         $produit->prix = $prix;
            //         $produit->imgurl = Outil::uploadFile($img, 'uploads/produits')['pathtocall'];
            //         $isProduitsaved = $produit->save();
            //     }

            //     if (!$isProduitsaved) {
            //         throw new \Exception("Erreur lors de l'enregistrement du produit");
            //     }
            // }
            // if ($cpt >= $rows->count()) {
            //     return array(
            //         "data" => 1
            //     );
            // }
        } catch (\Exception $e) {
            dd($e);
            return Outil::getResponseError($e);
        }
    }
}
