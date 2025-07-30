<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Vart;

class FactureEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $vart;
    public $pdfPath;

    public function __construct(User $user, Vart $vart, $pdfPath = null)
    {
        $this->user = $user;
        $this->vart = $vart;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        $mail = $this->view('emails.validation_panier') // ✅ Template pour le client
                    ->subject('Votre facture OumiShop - Commande #' . $this->vart->id)
                    ->with([
                        'user' => $this->user,
                        'vart' => $this->vart, // ✅ Ajout de la variable manquante
                        'loginUrl' => route('login')
                    ]);

        // Attacher le PDF si disponible
        if ($this->pdfPath && file_exists($this->pdfPath)) {
            $mail->attach($this->pdfPath, [
                'as' => 'facture-oumishop-' . $this->vart->id . '.pdf',
                'mime' => 'application/pdf'
            ]);
        }

        return $mail;
    }
} 