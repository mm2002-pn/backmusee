<?php

namespace App\Imports;

use App\Models\Outil;
use App\Models\Voiture;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class VoituresImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rows->shift();

        try {

            $cpt = 0;
            foreach ($rows as $row) {
                $cpt++;
                $marque = trim($row[0]);
                $codedepot = trim($row[1]);
                $matricule = trim($row[2]);
                //  dd($rows);
                // Vérification des données requises
                if (empty($marque)) {
                    throw new \Exception("Certaines données sont manquantes dans le fichier excel");
                }

                // Recherche de la zone associée
                $voiture = Voiture::where('marque', strtoupper($marque))
                    ->where('code', $codedepot)
                    ->where('matricule', strtoupper($matricule))
                    ->first();
                if (!isset($voiture)) {
                    $voiture = new Voiture();
                }
                $voiture->matricule = strtoupper($matricule);
                $voiture->marque = $marque ?? null;
                $voiture->code = $codedepot ?? null;
                $isvoituresaved = $voiture->save();



                if (!$isvoituresaved) {
                    throw new \Exception("Erreur lors de l'enregistrement du voiture");
                }
            }
            if ($cpt >= $rows->count()) {
                return array(
                    "data" => 1
                );
            }
        } catch (\Exception $e) {
            return Outil::getResponseError($e);
        }
    }
}
