<?php

namespace App\Imports;

use App\Models\Article;
use App\Models\Fabricant;
use App\Models\Fournisseur;
use App\Models\Outil;
use App\Models\Pays;
use App\Models\Prequalification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class PrequalificationsImport implements ToCollection
{


    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

        Prequalification::Truncate();
        $collection->shift();
        $cpt = 0;

        foreach ($collection as $index => $row) {
            try {
                $anneeprequal    = $row[0] ?? null;
                $anneeexpiration = $row[1] ?? null;
                $refaoip         = $row[2] ?? null;
                $code            = $row[3] ?? null;
                $categorie       = $row[4] ?? null;
                $denomination    = trim($row[5] ?? '');
                $cdt             = $row[6] ?? null;
                $nomfournisseur  = trim($row[7] ?? '');
                $nomfabricant    = trim($row[8] ?? '');
                $adresse         = $row[9] ?? null;
                $paysName        = trim($row[10] ?? '');
                $statut          = $row[11] ?? null;
                $statut = (strtolower($statut) == 'qualifie')
                    ? 1
                    : (
                        (strtolower($statut) == 'requalifie')
                        ? 2
                        : (
                            (strtolower($statut) == 'prequalifié')
                            ? 0
                            : null));

                // Vérification fournisseur
                $fournisseur = Fournisseur::where('nom', Outil::getOperateurLikeDB(), '%' . $nomfournisseur . '%')->first();
                if (!$fournisseur) {
                    Log::warning("Ligne " . ($index + 2) . " : Le fournisseur '{$nomfournisseur}' n'existe pas.");
                    continue;
                }

                // Vérification pays
                $pays = Pays::where('designation', Outil::getOperateurLikeDB(), '%' . $paysName . '%')->first();
                if (!$pays) {
                    Log::warning("Ligne " . ($index + 2) . " : Le pays '{$paysName}' n'existe pas.");
                    continue;
                }

                // fabriquant
                $fabricant = Fabricant::where('designation', Outil::getOperateurLikeDB(), '%' . $nomfabricant . '%')->first();
                if (!$fabricant) {
                    Log::warning("Ligne " . ($index + 2) . " : Le fabriquant '{$nomfabricant}' n'existe pas.");
                    continue;
                }

                // article
                $article = Article::where('designation', Outil::getOperateurLikeDB(), '%' . $denomination . '%')->first();
                if (!$article) {
                    Log::warning("Ligne " . ($index + 2) . " : L'article '{$denomination}' n'existe pas.");
                    continue;
                }

                // Mise à jour si existe déjà, sinon création
                $prequal = Prequalification::updateOrCreate(
                    [
                        'fournisseur_id'        => $fournisseur->id,
                        'referenceaoip'         => $refaoip,
                        'anneeprequalification' => $anneeprequal,
                        'fabriquant'            => $nomfabricant,
                    ],
                    [
                        'anneeexpiration' => $anneeexpiration,
                        'code'            => $code,
                        'type'            => $categorie, // correspond à enum(C,M)
                        'denomination'    => $denomination,
                        'cdt'             => $cdt,
                        'fabriquant'    => $nomfabricant,
                        'fabriquant_id'   => $fabricant->id,
                        'adresse'         => $adresse,
                        'pays_id'         => $pays->id,
                        'statut'          => $statut,
                        'article_id'      => $article->id,
                    ]
                );

                Log::info("Ligne " . ($index + 2) . " : Préqualification importée (ID {$prequal->id}).");
                $cpt++;
            } catch (\Exception $e) {
                Log::error("Erreur à la ligne " . ($index + 2) . " : " . $e->getMessage());
                continue;
            }
        }

        Log::info("{$cpt} préqualifications importées.");
        return $cpt;
    }
}
