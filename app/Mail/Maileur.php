<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Maileur extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $sujet;
    private $texte;
    private $page;
    private $email;
    private $name;


    public function __construct($sujet, $texte, $email, $name, $page, $pdfPath, $filejoin)
    {
        $this->sujet = $sujet;
        $this->texte = $texte;
        $this->page = $page;
        $this->email = $email;
        $this->name = $name;
        $this->pdfPath = $pdfPath;
        $this->filejoin = $filejoin;
    }

    public function build()
    {
        try {
            // dd($this->pdfPath);
            // Définir l'email avec une vue Blade valide
            $email = $this->from($this->email, "ETPP")
                ->subject($this->sujet)
                ->view('emails.' . $this->page, [
                    'texte' => $this->texte,
                    'from' => $this->email,
                    'nom' => $this->name,
                ]);

            // Ajouter l'attachement du PDF généré
            if ($this->pdfPath) {
                $email->attach(storage_path('app/' . $this->pdfPath), [
                    'as' => 'Résumé_Demande.pdf', // Nom du fichier attaché
                    'mime' => 'application/pdf',
                ]);
            }

            // Vérifier si un fichier supplémentaire est joint
            if ($this->filejoin) {
                // dd($this->pdfPath);
                $filePath = public_path($this->filejoin);
                // dd($filePath);

                // Si le fichier existe, on l'attache comme fichier supplémentaire
                if (file_exists($filePath)) {
                    $email->attach($filePath, [
                        'as' => 'Fichier_Supplémentaire.pdf',
                        'mime' => 'application/pdf',
                    ]);
                }
            }
                // dd($email);
            return $email;
        } catch (\Throwable $th) {
            //throw $th;
            dd($th,"maolleru");
            // TODO: Implement logging or sending email failure notification here
            return null; // Return null to avoid sending an email in case of an error
        }
    }
}
