<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CambioEquipo extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Registros de Nuevo(s) Equipos";
    public $equipos;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $equipos)
    {
        $this->equipos = $equipos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.notificacion')->with('equipos', $this->equipos);
    }
    
}
