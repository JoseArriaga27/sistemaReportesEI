<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Mail\LoginNotificacion;
use Illuminate\Support\Facades\Mail;

class SendLoginNotification
{
    public function handle(UserLoggedIn $event): void
    {
        $usuario = $event->usuario;

        Mail::to($usuario->correoElectronico)
            ->send(new LoginNotificacion(
                $usuario->nombre . ' ' . $usuario->apellidoPaterno,
                $usuario->correoElectronico
            ));
    }
}
