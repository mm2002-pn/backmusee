<?php

namespace App\Imports;

use App\Models\Categoriepointdevente;
use App\Models\Outil;
use App\Models\Pointdevente;
use App\Models\Typepointdevente;
use App\Models\Zone;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class PointdeventesImport implements ToCollection, WithCalculatedFormulas
{
    /**
     * Handle the import of Point de Vente data from an Excel file.
     *
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        // Remove the header row
        $rows->shift();

        try {
            $importedCount = 0;

            foreach ($rows as $index => $row) {
                if ($row->filter()->isEmpty()) {
                    continue;
                }
                // dd($row);


                // Extract data
                $name = trim($row[0]);
                $phone_1 = trim($row[1]);
                $categorie_1 = trim($row[2]);
                $categorie_2 = trim($row[3]);
                $id_ = trim($row[4]);
                $clef = trim($row[5]);
                $pointdevente = trim($row[7]);
                $zone = isset($row[9]) ? trim($row[9]) : null;
                $lat = isset($row[11]) ? (float) trim($row[11]) : 0.0;
                $long =  isset($row[12]) ? (float) trim($row[12]) : 0.0;
                $img =  isset($row[13]) ? trim($row[13]) : null;


                // Fetch or create zone
                $zn = Zone::where('designation', 'LIKE', '%' . $zone . '%')->first();

                if (!$zn) {
                    continue;
                }
                // dd($lat, $long,$zn);

                // crer typepointdevente

                $typepointdevente = Typepointdevente::where('designation', 'LIKE', '%' . $categorie_1 . '%')->first();

                if (!$typepointdevente) {
                    $typepointdevente = new Typepointdevente();
                    $typepointdevente->designation = $categorie_1;
                    $typepointdevente->save();
                }

                // Créer ou récupérer la catégorie de point de vente
                $categoriepointdevente = Categoriepointdevente::where('designation', 'LIKE', '%' . $categorie_2 . '%')->first();

                if (!$categoriepointdevente) {
                    $categoriepointdevente = new Categoriepointdevente();
                    $categoriepointdevente->designation = $categorie_2;
                    $categoriepointdevente->save();
                }


                // Check for existing Pointdevente by unique attributes
                $existingPdv = Pointdevente::where('designation', $name)
                    ->where('numbcpttier', $id_)
                    ->first();

                if ($existingPdv) {
                    $pdv = $existingPdv;
                } else {
                    $pdv = new Pointdevente();
                }

                $pdv->designation = $name;
                $pdv->telephone = $phone_1;
                $pdv->typepointdevente_id = $typepointdevente->id ?? null;
                $pdv->categoriepointdevente_id = $categoriepointdevente->id ?? null;
                $pdv->numbcpttier = $id_;
                $pdv->clef = $clef;
                $pdv->adresse = $pointdevente;
                $pdv->latitude = $lat;
                $pdv->longitude = $long;
                $pdv->gps = $lat . ',' . $long;
                $pdv->images = $img;
                $pdv->zone_id = $zn->id ?? null;
                $pdv->save();

                $importedCount++;
            }

            Log::info("$importedCount Point de Vente(s) successfully imported.");
        } catch (\Exception $e) {
            dd($e->getMessage());
            // Log the error with specific details
            Log::error("Error during import: " . $e->getMessage());
            throw new \Exception("An error occurred during the import process. Please check the logs for details.");
        }
    }
}
