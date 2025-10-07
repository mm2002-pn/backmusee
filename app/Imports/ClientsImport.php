<?php

namespace App\Imports;

use App\Models\Client;
use App\Models\Outil;
use App\Models\Pointdevente;
use App\Models\Role;
use App\Models\User;
use App\Models\Zone;
use App\Models\Zonepointdevente;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class ClientsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rows->shift();

        try {

            $cpt = 0;
            foreach ($rows as $row) {
                $cpt++;
                $cptTiers = trim($row[0]);
                $intitule = trim($row[1]);
                $cptCollectif = trim($row[2]);
                $zoneName = trim($row[3]);
                /// dd($intitule, $intitule, $cptCollectif, $zoneName);
                // Vérification des données requises
                if (empty($cptTiers) || empty($intitule) || empty($cptCollectif)) {
                    //dd($intitule, $intitule, $cptCollectif, $zoneName);

                    throw new \Exception("Certaines données sont manquantes dans le fichier excel");
                }

                // Recherche de la zone associée
                $zone = Zone::where('designation', $zoneName)->first();

                if (!isset($zone)) {
                    $zone = new Zone();
                    $zone->designation = $zoneName;
                    $isZonesaved = $zone->save();
                } else {
                    $isZonesaved = true; // La zone existe déjà, pas besoin de sauvegarder à nouveau.
                }

                $newclient = Client::where('numbcpttier', $cptTiers)->first();

                if (!isset($newclient)) {
                    $newclient = new Client();
                } else {
                    $isClientsaved = true;
                }
                $newclient->numbcpttier = $cptTiers;
                $newclient->intitule = $intitule;
                $newclient->cptcollectif = $cptCollectif;
                $isClientsaved = $newclient->save();

                if ($isClientsaved && $isZonesaved) {
                    $pointdevente = Pointdevente::where('numbcpttier', $cptTiers)->first();

                    if (!isset($pointdevente)) {
                        $pointdevente = new Pointdevente();
                    } else {
                        $ispointcreste = true;
                    }
                    $pointdevente->client_id = $newclient->id;
                    $pointdevente->intitule = $newclient->intitule;
                    $pointdevente->numbcpttier = $newclient->numbcpttier;
                    $pointdevente->latitude = null;
                    $pointdevente->longitude = null;
                    $pointdevente->gps = null;
                    $ispointcreste =  $pointdevente->save();

                    //zones pointdevente
                    if ($ispointcreste) {
                        $zonepointdevente = Zonepointdevente::where("zone_id", $zone->id)
                        ->where('pointdevente_id', $pointdevente->id)->first();

                        if (!isset($zonepointdevente)) {
                            $zonepointdevente = new Zonepointdevente();
                        }
                        $zonepointdevente->zone_id = $zone->id;
                        $zonepointdevente->pointdevente_id = $pointdevente->id;
                        $zonepointdevente->save();
                    }
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
