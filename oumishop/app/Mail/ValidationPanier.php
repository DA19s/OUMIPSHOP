<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Vart;

class ValidationPanier extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $admin;
    public $vart; // ✅ Ajout de la propriété manquante

    public function __construct(User $user, User $admin, Vart $vart = null) // ✅ Ajout du paramètre
    {
        $this->admin = $admin;
        $this->user = $user;
        $this->vart = $vart; // ✅ Assignation
    }

    public function build()
    {
        return $this->view('emails.notification_admin') // ✅ Template pour l'admin
                    ->subject('Nouvelle commande ! 👜')
                    ->with([
                        'user' => $this->user,
                        'admin' => $this->admin,
                        'vart' => $this->vart, // ✅ Ajout de la variable
                        'loginUrl' => route('login')
                    ]);
    }
}