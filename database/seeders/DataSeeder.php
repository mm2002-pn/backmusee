<?php

namespace Database\Seeders;

use App\Enums\Etape;
use App\Models\Client;
use App\Models\Documentspecification;
use App\Models\Outil;
use App\Models\Parcourmarche;
use App\Models\Typemarche;
use Illuminate\Database\Seeder;
use App\Models\Typeao;
use App\Models\Typecondition;
use App\Models\Typefournisseur;
use App\Models\Typeprocedure;
use App\Models\Fichierfournisseur;
use App\Models\Mesure;
use App\Models\Remisedureedevie;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        $mesures = [
            ['designation' => 'INTÉGRATION EN TANT QUE PARTENAIRE STRATÉGIQUE', 'description' => 'Capacité du fournisseur à honorer ses engagements contractuels sans se désister.'],
            ['designation' => 'REMERCIEMENTS ET ENCOURAGEMENTS', 'description' => ''],
            ['designation' => 'AVERTISSEMENTS', 'description' => ''],
        ];

        foreach ($mesures as $mesure) {
            $existing = Mesure::where('designation', $mesure['designation'])->first();
            if (!$existing) {
                Mesure::create($mesure);
            }
        }


        // remisedureedevie

        $remisedureedevies = [
            // Exemples de remises pour type de durée 1 court terme
            [
                'typeduree' => 1,
                'moinsnim' => 4,
                'moismax' => 6,
                'remisepourcentage' => 25,
                'remisevaleur' => null,
            ],
            [
                'typeduree' => 1,
                'moinsnim' => 2,
                'moismax' => 3,
                'remisepourcentage' => 50,
                'remisevaleur' => null,
            ],


            // Exemples de remises pour type de durée 0 normal
            [
                'typeduree' => 0,
                'moinsnim' => 1,
                'moismax' => 2,
                'remisepourcentage' => 75,
                'remisevaleur' => null,
            ],
            [
                'typeduree' => 0,
                'moinsnim' => 3,
                'moismax' => 4,
                'remisepourcentage' => 50,
                'remisevaleur' => null,
            ],
            [
                'typeduree' => 0,
                'moinsnim' => 5,
                'moismax' => 6,
                'remisepourcentage' => 30,
                'remisevaleur' => null,
            ],
            [
                'typeduree' => 0,
                'moinsnim' => 7,
                'moismax' => 9,
                'remisepourcentage' => 25,
                'remisevaleur' => null,
            ],


        ];


        foreach ($remisedureedevies as $remisedureedevie) {
            Remisedureedevie::create($remisedureedevie);
        }






        // Type Ao
        $typeAo = [
            ["designation" => "national"],
            ["designation" => "international"],
            ["designation" => "restreint"],
        ];

        foreach ($typeAo as $item) {
            $existing = Typeao::where('designation', $item['designation'])->first();
            if (!$existing) {
                Typeao::create($item);
            }
        }

        // Type Procedure
        $typeProcedure = [
            ["designation" => "ouverte"],
            ["designation" => "restreint"],
            ["designation" => "national"],
        ];

        foreach ($typeProcedure as $item) {
            $existing = Typeprocedure::where('designation', $item['designation'])->first();
            if (!$existing) {
                Typeprocedure::create($item);
            }
        }

        // Type Fournisseur
        $typeFournisseur = [
            ["designation" => "National"],
            ["designation" => "International"],
        ];

        foreach ($typeFournisseur as $item) {
            $existing = Typefournisseur::where('designation', $item['designation'])->first();
            if (!$existing) {
                Typefournisseur::create($item);
            }
        }

        // Type Condition
        $typeCondition = [
            ["designation" => "DDP"],
            ["designation" => "CIF"],
            ["designation" => "CIP"],
        ];

        foreach ($typeCondition as $item) {
            $existing = Typecondition::where('designation', $item['designation'])->first();
            if (!$existing) {
                Typecondition::create($item);
            }
        }

        // Dossier Fournisseur
        $dossierFournisseur = [
            ["designation" => "attestation_fiscale"],
            ["designation" => "extrait_kbis"],
            ["designation" => "ordre_transit"],
            ["designation" => "engagement_livraison"],
            ["designation" => "references_clients"],
            ["designation" => "certificat_qualification"],
        ];

        foreach ($dossierFournisseur as $item) {
            $existing = Fichierfournisseur::where('designation', $item['designation'])->first();
            if (!$existing) {
                Fichierfournisseur::create($item);
            }
            $typemarches = [
                [
                    "code" => "2",
                    "designation" => "AMI",
                    'description' => "AMI"
                ],
                [
                    "code" => "3",
                    "designation" => "AON",
                    'description' => "Appel d’offres ouverts national - AON"
                ],
                [
                    "code" => "4",
                    "designation" => "AOI",
                    'description' => "Appel d’offres ouverts Interna. - AOI"
                ],
                [
                    "code" => "5",
                    "designation" => "AOR",
                    'description' => "Appel d’offres restreints"
                ],
                [
                    "code" => "6",
                    "designation" => "Consultation",
                    'description' => "Consultation"
                ],
                [
                    "code" => "7",
                    "designation" => "Cotation",
                    'description' => "Cotation"
                ],
                [
                    "code" => "8",
                    "designation" => "Achat Direct",
                    'description' => "Achat Direct"
                ]

            ];

            foreach ($typemarches as $item) {
                $newitem = Typemarche::where([['designation', Outil::getOperateurLikeDB(), '%' . $item['designation'] . '%']])->first();
                if (!isset($newitem)) {
                    $newitem = new Typemarche();
                }
                $newitem->designation = $item['designation'];
                $newitem->description = $item['description'];
                $newitem->code = $item['code'];
                $newitem->save();
            }


            $parcours = [
                [
                    "designation" => "Quantification",
                    'description' => ""
                ],
                [
                    "designation" => "Target price",
                    'description' => ""
                ],
                [
                    "designation" => "Dao",
                    'description' => ""
                ],
                [
                    "designation" => "Appel d'offre",
                    'description' => "Achat Direct"
                ],
                [
                    "designation" => "Bon de commande",
                    'description' => ""
                ], [
                    "designation" => "Facture",
                    'description' => ""
                ],
                [
                    "designation" => "Reception",
                    'description' => ""
                ],
                [
                    "designation" => "Règlement",
                    'description' => ""
                ],

            ];

            foreach ($parcours as $prc) {
                $newitem = Parcourmarche::where([['designation', Outil::getOperateurLikeDB(), '%' . $prc['designation'] . '%']])->first();
                if (!isset($newitem)) {
                    $newitem = new Parcourmarche();
                }
                $newitem->designation = $prc['designation'];
                $newitem->description = $prc['description'];
                $newitem->save();
            }
        }




        $documentspecifications = [
            [
                "typedemarche" => "Tout",
                "etapetexte" => Etape::getText(Etape::SOUMISSION),
                "etape" => Etape::SOUMISSION,
                "designation" => "Attestation de régularité fiscale",
                "nature" => "Document"
            ],
            [
                "typedemarche" => "Tout",
                "etapetexte" => Etape::getText(Etape::SOUMISSION),
                "etape" => Etape::SOUMISSION,
                "designation" => "Extrait K-bis",
                "nature" => "Document"
            ],
            [
                "typedemarche" => "Tout",
                "etapetexte" => Etape::getText(Etape::SOUMISSION),
                "etape" => Etape::SOUMISSION,
                "designation" => "Certificat de qualification",
                "nature" => "Document"
            ],
            [
                "typedemarche" => "Medicament",
                "etapetexte" => Etape::getText(Etape::SOUMISSION),
                "etape" => Etape::SOUMISSION,
                "designation" => "Fabriquant",
                "nature" => "Document/Text"
            ],
            [
                "typedemarche" => "Tout",
                "etapetexte" => Etape::getText(Etape::SOUMISSION),
                "etape" => Etape::SOUMISSION,
                "designation" => "Contrat signée et datée",
                "nature" => "Document"
            ],
            [
                "typedemarche" => "Tout",
                "etapetexte" => Etape::getText(Etape::SUIVI_MARCHE),
                "etape" => Etape::SUIVI_MARCHE,
                "designation" => "Caution de bonne exécution",
                "nature" => "Document"
            ],
            [
                "typedemarche" => "Tout",
                "etapetexte" => Etape::getText(Etape::SUIVI_MARCHE),
                "etape" => Etape::SUIVI_MARCHE,
                "designation" => "Garantie bancaire",
                "nature" => "Document"
            ],
            [
                "typedemarche" => "Tout",
                "etapetexte" => Etape::getText(Etape::SUIVI_MARCHE),
                "etape" => Etape::SUIVI_MARCHE,
                "designation" => "BL/HB",
                "nature" => "Document/Text"
            ],
            [
                "typedemarche" => "Tout",
                "etapetexte" => Etape::getText(Etape::SUIVI_MARCHE),
                "etape" => Etape::SUIVI_MARCHE,
                "designation" => "LTA/HAWB",
                "nature" => "Document/Text"
            ],
            [
                "typedemarche" => "Tout",
                "etapetexte" => Etape::getText(Etape::SUIVI_MARCHE),
                "etape" => Etape::SUIVI_MARCHE,
                "designation" => "Facturé datée, signée/tamponnée avec l’adresse exacte du fournisseur et l’adresse de SALAMA",
                "nature" => "Document/Text"
            ],
            [
                "typedemarche" => "Tout",
                "etapetexte" => Etape::getText(Etape::SUIVI_MARCHE),
                "etape" => Etape::SUIVI_MARCHE,
                "designation" => "Packing list",
                "nature" => "Document/Text"
            ],
            [
                "typedemarche" => "Tout",
                "etapetexte" => Etape::getText(Etape::SUIVI_MARCHE),
                "etape" => Etape::SUIVI_MARCHE,
                "designation" => "Déclaration à l’export",
                "nature" => "Document/Text"
            ],
            [
                "typedemarche" => "Tout",
                "etapetexte" => Etape::getText(Etape::SUIVI_MARCHE),
                "etape" => Etape::SUIVI_MARCHE,
                "designation" => "BSC validé",
                "nature" => "Document"
            ],
            [
                "typedemarche" => "Tout",
                "etapetexte" => Etape::getText(Etape::SUIVI_MARCHE),
                "etape" => Etape::SUIVI_MARCHE,
                "designation" => "COA (Certificat of analysis)",
                "nature" => "Document"
            ],
        ];




        foreach ($documentspecifications as $doc) {
            // Chercher le typemarche correspondant
            $typemarche = Typemarche::where('designation', $doc['typedemarche'])->first();

            Documentspecification::updateOrCreate(
                ['designation' => $doc['designation']],
                [
                    'etape'         => $doc['etape'],
                    'etatetexte'    => $doc['etapetexte'],
                    'nature'        => $doc['nature'],
                    'typemarche_id' => $typemarche ? $typemarche->id : null,
                ]
            );
        }
    }
}
