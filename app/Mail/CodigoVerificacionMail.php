<?php

namespace App\Mail;

use App\Models\CodigoVerificacion;
use App\Models\Usuario;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CodigoVerificacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Usuario $usuario,
        public CodigoVerificacion $codigoVerificacion
    ) {
    }

    public function build(): self
    {
        return $this->subject('Codigo de verificacion 2FA')
            ->view('emails.codigo-verificacion');
    }
}
