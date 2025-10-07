<?php

namespace App\Imports;

use App\Models\Zone;
use App\Models\Antenne;
use App\Traits\ResponseTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class AntennesImport implements ToCollection
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
            $cptAntennes = 0; // Compteur pour les antennes créées

            foreach ($rows as $row) {
                $decouper = explode(",", $row[0]);
                $zoneName = trim($decouper[3]); // Nom de la zone
                $antenneCode = trim($decouper[2]); // Code de l'antenne
                $parent = intval(trim($decouper[5])); // Code de l'antenne parente

                if (isset($parent) && $parent == 68797) {
                    // Création ou récupération de l'antenne
                    $antenne = Antenne::firstOrCreate(
                        ['code' => $antenneCode],
                        ['designation' => $zoneName]
                    );
                }
            }

            return $this->sendResponse(
                "Importation réussie",
                [
                    'antennes' => $cptAntennes,
                ]
            );
        } catch (\Throwable $th) {
            dd($th);
            return $this->sendError("Erreur lors de l'importation : " . $th->getMessage());
        }
    }
}
