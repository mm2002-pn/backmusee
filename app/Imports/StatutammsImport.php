<?php

namespace App\Imports;

use App\Models\Fabricant;
use App\Models\Fournisseur;
use App\Models\Statutamm;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class StatutammsImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        // Supprimer la première ligne (en-têtes)
        Statutamm::Truncate();
        $collection->shift();

        $count = 0;

        foreach ($collection as $index => $row) {
            try {
                $codeproduit          = $row[0] ?? null;
                $designation          = $row[1] ?? null;
                $nomcommercialproduit = $row[2] ?? null;
                $nomfournisseur       = $row[3] ?? null;
                $laboratoire          = trim($row[4] ?? null);
                $labofabriquant       = trim($row[5] ?? null);
                $numeroamm            = $row[6] ?? null;
                $datedelivrance       = $row[7] ?? null; // string
                $dateexpiration       = $row[8] ?? null; // string
                $statut               = $row[9] ?? null;
                $statut =  strpos(strtolower($statut), 'amm valide') !== false ? 1 : 0;

                // Chercher le fournisseur
                $fournisseur = null;
                $fournisseurId = null;
                if ($nomfournisseur) {
                    $fournisseur = Fournisseur::where('nom', 'ilike', "%$nomfournisseur%")->first();
                    $fournisseurId = $fournisseur ? $fournisseur->id : null;

                    if (!$fournisseur) {
                        Log::warning("Ligne " . ($index + 2) . " : Fournisseur '$nomfournisseur' non trouvé.");
                    }
                }


                // recherche fabriquant

                $laboratoire = Fabricant::where('designation', 'ilike', "%$laboratoire%")->first() ? $laboratoire : null;
                $labofabriquant = Fabricant::where('designation', 'ilike', "%$labofabriquant%")->first() ? $labofabriquant : null;
                if (!$laboratoire) {
                    Log::warning("Ligne " . ($index + 2) . " : Laboratoire titulaire '$laboratoire' non trouvé.");
                }
                if (!$labofabriquant) {
                    Log::warning("Ligne " . ($index + 2) . " : Laboratoire fabriquant '$labofabriquant' non trouvé.");
                }   

                // Création ou mise à jour
                $statutamm = Statutamm::updateOrCreate(
                    ['numeroamm' => $numeroamm], // clé unique pour éviter doublons
                    [
                        'codeproduit'          => $codeproduit,
                        'designationsalama'    => $designation,
                        'nomcommercial'        => $nomcommercialproduit,
                        'nomfournisseur'       => $nomfournisseur,
                        'fournisseur_id'       => $fournisseurId,
                        'laboratoiretitulaire_id' => $laboratoire ? $laboratoire->id : null,
                        'laboratoirefabriquant_id' => $labofabriquant ? $labofabriquant->id : null,
                        'datedelivranceamm'    => $datedelivrance,
                        'dateexpirationamm'    => $dateexpiration,
                        'statutenregistrement' => $statut,
                    ]
                );

                Log::info("Ligne " . ($index + 2) . " : StatutAMM importé (ID {$statutamm->id})");
                $count++;
            } catch (\Exception $e) {
                Log::error("Erreur à la ligne " . ($index + 2) . " : " . $e->getMessage());
            }
        }

        Log::info("$count StatutAMMs importés avec succès.");
    }
}
