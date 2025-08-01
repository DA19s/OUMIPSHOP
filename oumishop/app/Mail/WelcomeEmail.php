<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.welcome')
                    ->subject('Bienvenue chez OumiShop ! 👜')
                    ->with([
                        'user' => $this->user,
                        'loginUrl' => route('login')
                    ]);
    }
}