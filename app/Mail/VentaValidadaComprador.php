<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Models\Venta;

class VentaValidadaComprador extends Mailable
{
    public $venta;

    public function __construct(Venta $venta)
    {
        $this->venta = $venta;
    }

    public function build()
    {
        return $this->subject('Compra validada')
            ->view('emails.compra_validada');
    }
}