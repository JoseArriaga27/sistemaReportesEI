<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellidoPaterno',
        'apellidoMaterno',
        'correoElectronico',
        'telefono',
        'fechaNacimiento',
        'password',
        'es_admin',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'es_admin' => 'boolean'
    ];
}