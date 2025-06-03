<?php

namespace App\Mail;

use App\Models\Alumno;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BienvenidaAlumnoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $alumno;

    /**
     * Create a new message instance.
     */
    public function __construct(Alumno $alumno)
    {
        $this->alumno = $alumno;
    }

    public function build()
    {
        return $this->subject('¡Bienvenido a la institución!')
            ->view('emails.bienvenida');
    }
}
