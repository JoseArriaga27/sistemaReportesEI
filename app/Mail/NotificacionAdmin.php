<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public string $nombreUsuario;
    public string $correoUsuario;
    public string $mensaje;
    public string $urlSistema;

    public function __construct(string $nombreUsuario, string $correoUsuario, string $mensaje = '')
    {
        $this->nombreUsuario = $nombreUsuario;
        $this->correoUsuario = $correoUsuario;
        $this->mensaje       = $mensaje ?: 'Le informamos que su cuenta ha sido actualizada en el Sistema de Reportes.';
        $this->urlSistema    = config('app.url') . '/usuarios';
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📢 Notificación del Sistema de Reportes',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.notificacion-admin',
        );
    }
}
