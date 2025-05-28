<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReporteCiudadanosMail extends Mailable
{
    use Queueable, SerializesModels;

    public $citiesWithCount;

    public function __construct($citiesWithCount)
    {
        $this->citiesWithCount = $citiesWithCount;
    }

    public function build()
    {
        return $this
            ->subject('Reporte de Ciudades y Ciudadanos')
            ->markdown('emails.reporte')
            ->with(['citiesWithCount' => $this->citiesWithCount]);
    }
}
