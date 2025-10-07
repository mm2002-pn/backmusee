<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Maileur2 extends Mailable
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

    public function __construct($sujet, $texte, $page)
    {
        $this->sujet = $sujet;
        $this->texte = $texte;
        $this->page = $page;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        /* return $this->from('monsite@chezmoi.com')
            ->view('emails.maileur'); */

        return $this->from('no-reply.ssp@h-tsoft.com')
            ->subject($this->sujet)
            ->cc(['abou050793@gmail.com'])
            ->view('emails.' . $this->page, array(
                'texte' => $this->texte,
            ));
    }
}
