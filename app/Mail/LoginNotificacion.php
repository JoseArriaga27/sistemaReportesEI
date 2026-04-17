<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoginNotificacion extends Mailable
{
    use Queueable, SerializesModels;

    public string $nombreUsuario;
    public string $correoUsuario;
    public string $fechaHora;
    public string $urlSistema;

    public function __construct(string $nombreUsuario, string $correoUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;
        $this->correoUsuario = $correoUsuario;
        $this->fechaHora     = now()->format('d/m/Y H:i:s');
        $this->urlSistema    = config('app.url') . '/usuarios';
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🔐 Inicio de sesión detectado - Sistema de Reportes',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.login-notificacion',
        );
    }
}
