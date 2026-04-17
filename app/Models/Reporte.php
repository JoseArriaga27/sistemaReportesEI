<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reportes';

    protected $fillable = [
        'titulo',
        'descripcion',
        'estado',
        'prioridad',
        'categoria_id',
        'usuario_id',
        'fecha_limite',
        'notas',
    ];

    protected $casts = [
        'fecha_limite' => 'date',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function getEstadoBadgeClass(): string
    {
        return match($this->estado) {
            'pendiente'   => 'badge-estado-pendiente',
            'en_revision' => 'badge-estado-revision',
            'resuelto'    => 'badge-estado-resuelto',
            'rechazado'   => 'badge-estado-rechazado',
            default       => 'badge-estado-pendiente',
        };
    }

    public function getPrioridadBadgeClass(): string
    {
        return match($this->prioridad) {
            'baja'    => 'badge-prio-baja',
            'media'   => 'badge-prio-media',
            'alta'    => 'badge-prio-alta',
            'critica' => 'badge-prio-critica',
            default   => 'badge-prio-media',
        };
    }
}
