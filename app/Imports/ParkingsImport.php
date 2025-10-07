<?php

namespace App\Imports;

use App\Models\Categoriefournisseur;
use App\Models\Chauffeur;
use App\Models\Fournisseur;
use App\Models\Outil;
use App\Models\Parking;
use App\Models\Tonnage;
use App\Models\Typevehicule;
use App\Models\Vehicule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Log;

class ParkingsImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $rows->shift();
        $count = 0;

        Parking::truncate();
        foreach ($rows as $index => $row) {
            // dd($row);
            try {
                $fournisserNom = trim($row[0]);
                $matricule = $row[1];
                $marque = trim($row[2]);
                $chauffeurNom = trim($row[3]);
                $description = $row[6];
                $tonnagevalue = $row[8];
                $volume = $row[9];
                $typeVehicule = trim($row[10]);
                // Vérifier les données obligatoires
                if (empty($matricule)) {
                    Log::warning("Ligne " . ($index + 2) . " : Matricule vide, ligne ignorée.");
                    continue;
                }
                $categoriefournisseur = Categoriefournisseur::where('designation', Outil::getOperateurLikeDB(), '%FLOC%')->first();
                if (!$categoriefournisseur) {
                    Log::warning("Ligne " . ($index + 2) . " : Categoriefournisseur vide, ligne ignorée.");
                    continue;
                } else {
                    Log::info("Ligne " . ($index + 2) . " : Categoriefournisseur  - {$categoriefournisseur->designation}");
                }

                $fournisseur = Fournisseur::where('nom', Outil::getOperateurLikeDB(), "%$fournisserNom%")->first();
                if (!$fournisseur) {
                    $fournisseur = new Fournisseur();
                    $fournisseur->nom = $fournisserNom;
                    $fournisseur->email = $fournisserNom . "@gmail.com";
                    $fournisseur->TSSCOD_0_0 = "TRANS";
                    $fournisseur->adresse = "Adresse";
                    $fournisseur->telephone = "00000000";
                    $fournisseur->categoriefournisseur_id = $categoriefournisseur->id;
                    $fournisseur->save();
                    Log::info("Ligne " . ($index + 2) . " : Nouveau fournisseur créé - {$fournisseur->nom}");
                }

                // typevehicule_id
                $typevehicule = Typevehicule::where('designation', Outil::getOperateurLikeDB(), "%$typeVehicule%")->first();
                if (!$typevehicule) {
                    $typevehicule = new Typevehicule();
                    $typevehicule->designation = $typeVehicule;
                    $typevehicule->save();
                    Log::info("Ligne " . ($index + 2) . " : Nouveau type de véhicule créé - {$typevehicule->nom}");
                }


                $tonnage  = Tonnage::where('tonnage', Outil::getOperateurLikeDB(), "%$tonnagevalue%")->first();
                if (!$tonnage) {
                    $tonnage = new Tonnage();
                    $tonnage->tonnage = $tonnagevalue;
                    $tonnage->designation = $tonnagevalue;
                    $tonnage->save();
                    Log::info("Ligne " . ($index + 2) . " : Nouveau tonnage créé - {$tonnage->tonnage}");
                }


                // chauffeur
                $chauffeur = Chauffeur::where('nom', Outil::getOperateurLikeDB(), "%$chauffeurNom%")->first();
                if (!$chauffeur) {
                    $chauffeur = new Chauffeur();
                    $chauffeur->nom = $chauffeurNom;
                    $chauffeur->telephone = "00000000";
                    $chauffeur->email = $chauffeurNom . "@gmail.com";
                    $chauffeur->adresse = "Adresse";
                    $chauffeur->estinterne = 1;
                    $chauffeur->save();
                    Log::info("Ligne " . ($index + 2) . " : Nouveau chauffeur création - {$chauffeur->nom}");
                }


                // rechercher le vehicule par matricule

                $vehicule =  Vehicule::where('matricule', Outil::getOperateurLikeDB(), "%$matricule%")->first();
                if (!$vehicule) {
                    $vehicule = new Vehicule();
                    $vehicule->matricule = $matricule;
                    $vehicule->marque = $marque;
                    $vehicule->volume = $volume;
                    $vehicule->typevehicule_id = $typevehicule->id;
                    $vehicule->tonnage_id = $tonnage->id;
                    $vehicule->description = $description;
                    $vehicule->estinterne = 1;
                    $vehicule->chauffeur_id = $chauffeur->id;
                    $vehicule->save();
                    Log::info("Ligne " . ($index + 2) . " : Nouveau véhicule créé - {$vehicule->matricule}");
                }




                // parking vehicle et fournisseur

                $parking = Parking::where('vehicule_id', $vehicule->id)->where('fournisseur_id', $fournisseur->id)->first();
                if (!$parking) {
                    $parking = new Parking();
                    $parking->vehicule_id = $vehicule->id;
                    $parking->fournisseur_id = $fournisseur->id;
                    $parking->save();
                    Log::info("Ligne " . ($index + 2) . " : Parking associé - Véhicule {$vehicule->matricule} / Fournisseur {$fournisseur->nom}");
                    $count++;
                }
            } catch (\Throwable $th) {
                Log::error("Ligne " . ($index + 2) . " : {$th->getMessage()}");
            }
        }
        Log::info("$count associations Parking importées avec succès.");
    }
}
