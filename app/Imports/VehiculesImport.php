<?php

namespace App\Imports;

use App\Models\Outil;
use App\Models\Typevehicule;
use App\Models\Tonnage;
use App\Models\Vehicule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class VehiculesImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Supprimer la première ligne (en-têtes)
        $rows->shift();

        $count = 0;

        foreach ($rows as $index => $row) {
            try {
                // Ignorer les lignes vides
                if ($row->filter()->isEmpty()) {
                    continue;
                }

                $type        = trim($row[0] ?? '');
                $matricule   = trim($row[1] ?? '');
                $marque      = trim($row[2] ?? '');
                $tonnageStr  = trim($row[3] ?? '');
                $tonnageValue = Outil::parseTonnage($tonnageStr);
                $description = trim($row[4] ?? '');
                $volume      = is_numeric($row[5] ?? null) ? floatval($row[5]) : null;
                $volumevalue = trim(str_replace('m3', '', $row[5] ?? ''));
                // dd($volumevalue, $tonnageValue, $matricule, $type, $marque, $description, $tonnageStr);
                // Gestion du type de véhicule
                $typevehicule = Typevehicule::firstOrCreate(
                    ['designation' => $type],
                    ['designation' => $type]
                );

                // Gestion du tonnage (ex: "3.5T", "7T", etc.)
                $tonnage = null;
                if (!empty($tonnageStr)) {
                    $tonnage = Tonnage::firstOrCreate(
                        ['designation' => $tonnageStr, 'tonnage' => $tonnageValue],
                        [
                            'designation' => $tonnageStr,
                            'tonnage'      => $tonnageValue,
                        ]
                    );
                }

                // Création ou mise à jour du véhicule (par matricule)
                $vehicule = Vehicule::updateOrCreate(
                    ['matricule' => $matricule],
                    [
                        'typevehicule_id' => $typevehicule->id,
                        'marque'          => $marque,
                        'tonnage_id'      => $tonnage ? $tonnage->id : null,
                        'description'     => $description,
                        'volume'          => $volumevalue,
                    ]
                );

                Log::info("Ligne " . ($index + 2) . " : Véhicule importé (ID {$vehicule->id})");
                $count++;
            } catch (\Exception $e) {
                Log::error("Erreur à la ligne " . ($index + 2) . " : " . $e->getMessage());
            }
        }

        Log::info("$count véhicules importés avec succès.");
    }
}
