<?php

namespace App\Http\Controllers;

use App\Exports\ExcelBilanCommercial;
use App\Exports\ExcelEtatFinancier;
use App\Exports\Modele1Export;
use App\Exports\Modele2Export;
use App\Exports\Modele3Export;
use App\Exports\PrequalificationsExport;
use App\Exports\StatutammsExport;
use App\Models\Outil;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class PdfExcelController extends Controller
{
    public function generate_pdf_qrcode($filters = null)
    {
        $data  = Outil::getAllItemsWithGraphQl("pointdeventes", $filters);
        $dataclone = $data;
        // dd( $data);

        $dataclone = self::generateQrCode($dataclone);
        $data = array(
            'zone'                          => $data[0]['zone'],
            'data'                          => $dataclone,
        );
        // dd($data);
        $pdf = PDF::loadView('pdf.generate-pdf-codeqr', ['data' => $data]);
        return $pdf->stream('generate-pdf-codeqr.pdf');
    }

    public function generate_pdf_os()
    {
        $colisages = [
            ['produit' => 'Moustiquaires imprégnées', 'quantite' => 5000, 'unite' => 'pièces', 'destination' => 'Androy', 'date' => '15/08/2025'],
            ['produit' => 'Tests rapides Palu', 'quantite' => 2000, 'unite' => 'boîtes', 'destination' => 'Anosy', 'date' => '15/08/2025'],
            ['produit' => 'Artemisinin', 'quantite' => 1000, 'unite' => 'kits', 'destination' => 'Atsimo Andrefana', 'date' => '20/08/2025'],
        ];

        //  $pdf = Pdf::loadView('pdf.generate-pdf-os', compact('colisages'));
        //  return $pdf->download('Ordre_Service.pdf');

        $pdf = PDF::loadView('pdf.generate-pdf-os', ['colisages' => $colisages]);
        return $pdf->stream('generate-pdf-os.pdf');
    }

    public function generate_pdf_qrcode_oeuvre($filters = null)
    {
        $oeuvres = [
            [
                "id" => 1,
                "designation" => "Oba_Ozolua",
                "titre_fr" => "Plaque de bronze Oba Ozolua",
                "description_fr" => "Plaque de bronze représentant Oba Ozolua se préparant à la guerre.",
                "artiste" => "Artiste anonyme du royaume du Bénin",
                "date_creation" => "XVIe siècle",
                "origine" => "Royaume du Bénin, Nigeria",
                "image_url" => "images/musee/Oba_Ozolua_-_MCN_4185.jpg",
                "qr_code" => "MCN-OZOLUA-001",
            ],
            [
                "id" => 2,
                "designation" => "Oba_Oguola",
                "titre_fr" => "Portrait d'Oba Oguola",
                "description_fr" => "Représentation sculpturale d'Oba Oguola.",
                "artiste" => "Maître fondeur du Bénin",
                "date_creation" => "XVe siècle",
                "origine" => "Royaume du Bénin, Nigeria",
                "image_url" => "images/musee/Oba_Oguola_-_MCN_4179_(cropped2).jpg",
                "qr_code" => "MCN-OGUOLA-002",
            ],
            [
                "id" => 3,
                "designation" => "Armure_du_chasseur",
                "titre_fr" => "Armure du chasseur Dogon",
                "description_fr" => "Tenue rituelle du chasseur Dogon.",
                "artiste" => "Artisan Dogon anonyme",
                "date_creation" => "XIXe siècle",
                "origine" => "Pays Dogon, Mali",
                "image_url" => "images/musee/Armure_du_chasseur_Dogon.jpg",
                "qr_code" => "MCN-ARMURE-003",
            ],
        ];

        // Génération des QR Codes pour chaque œuvre
        $baseUrl = " https://6d83f6ca3e3e4cca99b70f23daa447d6-52851054f268497e8936cd731.fly.dev/qr?code=";

        foreach ($oeuvres as &$oeuvre) {
            $qrLink = $baseUrl . $oeuvre['qr_code'];
            $oeuvre['qr_link'] = $qrLink;

            $oeuvre['qr_code_image'] = base64_encode(
                QrCode::size(120)
                    ->margin(1)
                    ->generate($qrLink)
            );
        }


        // Pour vérifier dans les logs Laravel
        Log::info('QR codes générés pour les œuvres', ['count' => count($oeuvres)]);

        // Génération du PDF
        $pdf = Pdf::loadView('pdf.generate-pdf-qrcode-oeuvre', [
            'oeuvres' => $oeuvres
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('qr-codes-oeuvres-' . date('Y-m-d') . '.pdf');
    }




    private function generateQrCode($data)
    {
        $qrCodes = [];
        foreach ($data as $key => $value) {
            $qrCodes[$key] = [
                'qrcode' => QrCode::size(100)
                    // ->style('dot')
                    // ->eye('circle')
                    ->margin(1)
                    ->generate($value['numbcpttier']),
                'intitule' => $value['intitule']
            ];
            //dd( $qrCodes[$key]);
        }
        return $qrCodes;
    }
    // generate_excel_etat_financier
    public function generate_excel_etat_financier($filters = null)
    {
        // Débogage pour voir ce qui est reçu
        Log::info('Filters received:', ['filters' => $filters]);

        // Si $filters est une chaîne JSON, décodez-la
        if (is_string($filters)) {
            $soumissions = json_decode($filters, true);

            // Vérifiez si le décodage a réussi
            if (json_last_error() !== JSON_ERROR_NONE) {
                // Si ce n'est pas du JSON valide, traitez comme un tableau vide
                $soumissions = [];
            }
        } else {
            // Si c'est déjà un tableau, utilisez-le directement
            $soumissions = $filters ?? [];
        }

        // Assurez-vous que $soumissions est un tableau
        if (!is_array($soumissions)) {
            $soumissions = [];
        }

        // Passez les soumissions à l'export Excel
        return Excel::download(new ExcelEtatFinancier($soumissions), 'etat-financier-' . date('Y-m-d') . '.xlsx');
    }

    public function generate_excel_bilan_commercial($filters = null)
    {
        // dd($filters);
        $data = Outil::getAllItemsWithGraphQl("visites", $filters);
        //dd($data);
        return Excel::download(new ExcelBilanCommercial($data), 'bilan-commercial.xlsx');
    }

    public function pdfnumberpage($data, $page, $customPaper = null)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdfs.' . $page, $data);
        if (isset($customPaper)) {
            $pdf->setPaper($customPaper);
        }
        return $pdf->stream($page . '.pdf');
    }


    // modele1 execel
    public function generate_excel_modele1($data)
    {
        $appelOffre = [];
        return Excel::download(new Modele1Export($appelOffre), 'modele1_appel_offre_' . '.xlsx');
    }

    public function generate_excel_modele2($id)
    {
        $appelOffre = [];
        return Excel::download(
            new Modele2Export($appelOffre),
            'modele2_appel_offre_' . '.xlsx'
        );
    }

    public function generate_excel_modele3($id)
    {
        $appelOffre = [];

        return Excel::download(
            new Modele3Export($appelOffre),
            'modele3_appel_offre_' . '.xlsx'
        );
    }

    public function generate_excel_statutamm($filters = null)
    {
        $data = Outil::getAllItemsWithGraphQl("statutamms", $filters);
        $statutamms = $data ?? [];
        return Excel::download(
            new StatutammsExport($statutamms),
            'statutamm_' . '.xlsx'
        );
    }


    public function generate_excel_prequalification($filters = null)
    {
        $data = Outil::getAllItemsWithGraphQl("prequalifications", $filters);
        $statutamms = $data ?? [];
        return Excel::download(
            new PrequalificationsExport($statutamms),
            'prequalification_' . '.xlsx'
        );
    }

    // generate_pdf_caisse
    public function generate_pdf_caisse($filters = null)
    {
        $filters = "id:" . $filters;
        $data = Outil::getAllItemsWithGraphQl("bls", $filters);
        // dd($data[0]);
        $data = array(
            'data'                          => $data[0],
        );
        $pdf = PDF::loadView('pdf.generate-pdf-caisse', ['data' => $data]);
        $measure = array(0, 0, 190.772, 650.197);
        $pdf->setPaper($measure, 'orientation')->stream();
        return $pdf->stream('generate-pdf-caisse.pdf');
    }

    // generate_pdf_ventecaisse
    public function generate_pdf_ventecaisse($filters = null)
    {
        $filters = "id:" . $filters;
        $data = Outil::getAllItemsWithGraphQl("visites", $filters);
        // dd($data[0]);
        $data = array(
            'data'                          => $data[0],
        );
        $pdf = PDF::loadView('pdf.generate-pdf-ventecaisse', ['data' => $data]);
        $measure = array(0, 0, 190.772, 650.197);
        $pdf->setPaper($measure, 'orientation')->stream();
        return $pdf->stream('generate-pdf-ventecaisse.pdf');
    }
}
