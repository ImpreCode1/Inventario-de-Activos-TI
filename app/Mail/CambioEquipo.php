<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\CpuEquipo;

class CambioEquipo extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Registros de Nuevo(s) Equipos";
    public $equipos;
    public $url_edicion;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CpuEquipo $equipos, $url_edicion )
    {
        $this->equipos = $equipos;
        $this->url_edicion = $url_edicion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.notificacion')->with(['equipos' => $this->equipos, 'url_edicion' => $this->url_edicion]);

    }
    
}
