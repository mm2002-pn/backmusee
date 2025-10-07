<?php

namespace App\Imports;

use App\Models\Zone;
use App\Models\Antenne;
use App\Traits\ResponseTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class ZonesImport implements ToCollection
{
    
    use ResponseTrait;

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        
        // Suppression de la première ligne (en-tête)
        $rows->shift();

        try {
            $cptZones = 0; // Compteur pour les zones créées
            $cptAntennes = 0; // Compteur pour les antennes créées
            $antenne = $rows[0][5];
            $antenne  = Antenne::where('code', $antenne)->first();
            $rows->shift();

            foreach ($rows as $row) {
                // Découper les données
                $zoneName = trim($row[3]); // Nom de la zone

                // Création de la zone associée
                $zone = Zone::firstOrCreate(
                    ['designation' => $zoneName],
                    ['antenne_id' => $antenne->id]
                );

                $cptZones++;
            }

            return $this->sendResponse(
                "Importation réussie",
                [
                    'zones' => $cptZones,
                    'antennes' => $cptAntennes,
                ]
            );
        } catch (\Throwable $th) {
            dd($th);
            return $this->sendError("Erreur lors de l'importation : " . $th->getMessage());
        }
    }
}
