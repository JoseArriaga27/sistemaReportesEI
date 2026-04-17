<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Categoria;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        $query = Reporte::with(['categoria', 'usuario']);

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }
        if ($request->filled('prioridad')) {
            $query->where('prioridad', $request->prioridad);
        }
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        $reportes   = $query->orderByDesc('created_at')->get();
        $categorias = Categoria::orderBy('nombre')->get();

        $stats = [
            'total'       => Reporte::count(),
            'pendientes'  => Reporte::where('estado', 'pendiente')->count(),
            'en_revision' => Reporte::where('estado', 'en_revision')->count(),
            'resueltos'   => Reporte::where('estado', 'resuelto')->count(),
        ];

        return view('reportes.index', compact('reportes', 'categorias', 'stats'));
    }

    public function create()
    {
        $categorias = Categoria::where('activo', true)->orderBy('nombre')->get();
        $usuarios   = Usuario::orderBy('nombre')->get();
        return view('reportes.create', compact('categorias', 'usuarios'));
    }

    public function store(Request $request)
    {
        $esAdmin = (bool) session('usuarioAdmin');

        $rules = [
            'titulo'       => 'required|max:150',
            'descripcion'  => 'nullable|max:2000',
            'prioridad'    => 'required|in:baja,media,alta,critica',
            'categoria_id' => 'nullable|exists:categorias,id',
            'notas'        => 'nullable|max:1000',
        ];

        if ($esAdmin) {
            $rules['estado']       = 'required|in:pendiente,en_revision,resuelto,rechazado';
            $rules['usuario_id']   = 'nullable|exists:usuarios,id';
            $rules['fecha_limite'] = 'nullable|date';
        }

        $request->validate($rules);

        $datos = [
            'titulo'       => $request->titulo,
            'descripcion'  => $request->descripcion,
            'prioridad'    => $request->prioridad,
            'categoria_id' => $request->categoria_id,
            'notas'        => $request->notas,
        ];

        if ($esAdmin) {
            $datos['estado']       = $request->estado;
            $datos['usuario_id']   = $request->usuario_id;
            $datos['fecha_limite'] = $request->fecha_limite;
        } else {
            $datos['estado']       = 'pendiente';
            $datos['usuario_id']   = null;
            $datos['fecha_limite'] = null;
        }

        Reporte::create($datos);

        return redirect()->route('reportes.index')
            ->with('mensajeExito', 'Reporte creado correctamente.');
    }

    public function edit(Reporte $reporte)
    {
        $categorias = Categoria::where('activo', true)->orderBy('nombre')->get();
        $usuarios   = Usuario::orderBy('nombre')->get();
        return view('reportes.edit', compact('reporte', 'categorias', 'usuarios'));
    }

    public function update(Request $request, Reporte $reporte)
    {
        $esAdmin = (bool) session('usuarioAdmin');

        $rules = [
            'titulo'       => 'required|max:150',
            'descripcion'  => 'nullable|max:2000',
            'prioridad'    => 'required|in:baja,media,alta,critica',
            'categoria_id' => 'nullable|exists:categorias,id',
            'notas'        => 'nullable|max:1000',
        ];

        if ($esAdmin) {
            $rules['estado']       = 'required|in:pendiente,en_revision,resuelto,rechazado';
            $rules['usuario_id']   = 'nullable|exists:usuarios,id';
            $rules['fecha_limite'] = 'nullable|date';
        }

        $request->validate($rules);

        $datos = [
            'titulo'       => $request->titulo,
            'descripcion'  => $request->descripcion,
            'prioridad'    => $request->prioridad,
            'categoria_id' => $request->categoria_id,
            'notas'        => $request->notas,
        ];

        if ($esAdmin) {
            $datos['estado']       = $request->estado;
            $datos['usuario_id']   = $request->usuario_id;
            $datos['fecha_limite'] = $request->fecha_limite;
        }

        $reporte->update($datos);

        return redirect()->route('reportes.index')
            ->with('mensajeExito', 'Reporte actualizado correctamente.');
    }

    public function destroy(Reporte $reporte)
    {
        $reporte->delete();
        return redirect()->route('reportes.index')
            ->with('mensajeExito', 'Reporte eliminado correctamente.');
    }

    /**
     * API del clima usando Open-Meteo (gratuita, sin API Key, sin registro).
     * Documentación: https://open-meteo.com/en/docs
     * Endpoint: GET /api/clima?lat=18.9242&lon=-99.2216
     */
    public function clima(Request $request)
    {
        $lat = $request->get('lat', 18.9242);
        $lon = $request->get('lon', -99.2216);

        $url = "https://api.open-meteo.com/v1/forecast"
             . "?latitude={$lat}&longitude={$lon}"
             . "&current=temperature_2m,weathercode,windspeed_10m,relative_humidity_2m"
             . "&daily=temperature_2m_max,temperature_2m_min,weathercode"
             . "&timezone=America%2FMexico_City"
             . "&forecast_days=5";

        $ctx = stream_context_create(['http' => ['timeout' => 5]]);
        $raw = @file_get_contents($url, false, $ctx);

        if (!$raw) {
            return response()->json(['error' => 'No se pudo conectar con la API del clima'], 503);
        }

        $data = json_decode($raw, true);

        $codigos = [
            0  => 'Despejado',        1  => 'Mayormente despejado', 2  => 'Parcialmente nublado',
            3  => 'Nublado',          45 => 'Niebla',               48 => 'Niebla con escarcha',
            51 => 'Llovizna ligera',  53 => 'Llovizna moderada',    55 => 'Llovizna intensa',
            61 => 'Lluvia ligera',    63 => 'Lluvia moderada',      65 => 'Lluvia fuerte',
            71 => 'Nevada ligera',    73 => 'Nevada moderada',      75 => 'Nevada intensa',
            80 => 'Chubascos ligeros',81 => 'Chubascos moderados',  82 => 'Chubascos violentos',
            95 => 'Tormenta',         96 => 'Tormenta con granizo', 99 => 'Tormenta intensa',
        ];

        $wc     = $data['current']['weathercode'] ?? 0;
        $result = [
            'actual' => [
                'temperatura' => $data['current']['temperature_2m'] ?? '--',
                'humedad'     => $data['current']['relative_humidity_2m'] ?? '--',
                'viento'      => $data['current']['windspeed_10m'] ?? '--',
                'condicion'   => $codigos[$wc] ?? 'Desconocido',
                'codigo'      => $wc,
            ],
            'pronostico' => [],
        ];

        if (!empty($data['daily'])) {
            $dias = $data['daily'];
            for ($i = 0; $i < min(5, count($dias['time'])); $i++) {
                $wcd = $dias['weathercode'][$i] ?? 0;
                $result['pronostico'][] = [
                    'fecha'     => $dias['time'][$i],
                    'max'       => $dias['temperature_2m_max'][$i],
                    'min'       => $dias['temperature_2m_min'][$i],
                    'condicion' => $codigos[$wcd] ?? 'Desconocido',
                    'codigo'    => $wcd,
                ];
            }
        }

        return response()->json($result);
    }
}
