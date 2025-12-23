<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;

class ReportesController extends Controller
{
    public function index(Request $request)
    {
        // 1. Obtener listas para los filtros (mismos que en EquipoController)
        $condiciones = ['Nuevo', 'Bueno', 'Regular', 'Malo', 'Obsoleto'];
        $estados = ['Activo', 'Inactivo', 'En Mantenimiento', 'Dado de Baja', 'Asignado'];
        $departamentos = ['TI', 'Administración', 'Contabilidad', 'Recursos Humanos', 'Tienda', 'Marketing'];
        $categorias = ['Computadoras', 'Impresoras', 'Servidores', 'Redes', 'Telefonía', 'Electrónicos'];

        // 2. Query Base con Filtros
        $query = Equipo::query();

        // Filtro por Rango de Fechas (fecha_ingreso)
        if ($request->filled('fecha_inicio')) {
            $query->whereDate('fecha_ingreso', '>=', $request->fecha_inicio);
        }
        if ($request->filled('fecha_fin')) {
            $query->whereDate('fecha_ingreso', '<=', $request->fecha_fin);
        }

        // Otros filtros
        $query->when($request->filled('estado'), function ($q) use ($request) {
            return $q->where('estado', $request->estado);
        });

        $query->when($request->filled('condicion'), function ($q) use ($request) {
            return $q->where('condicion', $request->condicion);
        });

        $query->when($request->filled('departamento'), function ($q) use ($request) {
            return $q->where('departamento', $request->departamento);
        });

        $query->when($request->filled('categoria'), function ($q) use ($request) {
            return $q->where('categoria', $request->categoria);
        });

        // Obtener resultados (Todos para DataTables)
        if ($request->has('printtypes')) {
            $equipos = $query->select('equipo', \Illuminate\Support\Facades\DB::raw('SUM(cantidad) as total_cantidad'), \Illuminate\Support\Facades\DB::raw('MAX(activo_fijo) as ejemplo_activo_fijo'))
                             ->groupBy('equipo')
                             ->orderBy('total_cantidad', 'desc')
                             ->get();
        } else {
            $equipos = $query->orderBy('created_at', 'desc')->get();
        }

        // 3. Estadísticas Globales (KPIs)
        // Estas estadísticas reflejan el estado general del inventario, independientemente de los filtros
        // O si se prefiere que reaccionen a los filtros, se debería usar $query->clone()...
        // Por ahora, las mantendremos globales como KPIs fijos, o podemos hacer que "Equipos Activos" sea del filtro actual?
        // El diseño sugiere KPIs generales, pero "Resultados del Reporte" sugiere que la tabla es lo filtrado.
        // Vamos a hacer que los KPIs sean globales para dar contexto.

        $stats = [
            'activos' => Equipo::where('estado', 'Activo')->count(),
            'mantenimiento' => Equipo::where('estado', 'En Mantenimiento')->count(),
            'total_departamentos' => Equipo::distinct('departamento')->count('departamento'),
            // Nuevos este mes (basado en fecha_ingreso)
            'nuevos_mes' => Equipo::whereMonth('fecha_ingreso', now()->month)
                                  ->whereYear('fecha_ingreso', now()->year)
                                  ->count(),
        ];

        return view('reportes.indexreportes', compact(
            'equipos',
            'condiciones',
            'estados',
            'departamentos',
            'categorias',
            'stats'
        ));
    }
}
