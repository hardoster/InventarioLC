<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use Illuminate\Support\Facades\DB; // Importante para usar DB::raw

class ReportesController extends Controller
{
    public function index(Request $request)
    {
        // 1. Obtener listas para los filtros
        $condiciones = ['Nuevo', 'Bueno', 'Regular', 'Malo', 'Obsoleto'];
        $estados = ['Activo', 'Inactivo', 'En Mantenimiento', 'Dado de Baja', 'Asignado'];
        $departamentos = ['TI', 'Administración', 'Contabilidad', 'Recursos Humanos', 'Tienda', 'Marketing'];
        $categorias = ['Computadoras', 'Impresoras', 'Servidores', 'Redes', 'Telefonía', 'Electrónicos'];

        // 2. Query Base con Filtros
        $query = Equipo::query();

        // Filtro por Rango de Fechas
        if ($request->filled('fecha_inicio')) {
            $query->whereDate('fecha_ingreso', '>=', $request->fecha_inicio);
        }
        if ($request->filled('fecha_fin')) {
            $query->whereDate('fecha_ingreso', '<=', $request->fecha_fin);
        }

        // Otros filtros dinámicos
        $query->when($request->filled('estado'), fn($q) => $q->where('estado', $request->estado));
        $query->when($request->filled('condicion'), fn($q) => $q->where('condicion', $request->condicion));
        $query->when($request->filled('departamento'), fn($q) => $q->where('departamento', $request->departamento));
        $query->when($request->filled('categoria'), fn($q) => $q->where('categoria', $request->categoria));

        // 3. Obtener resultados principales ($equipos)
        if ($request->has('printtypes')) {
            // MODO AGRUPADO: Agregamos descripcion al select y al groupBy
            $equipos = $query->select(
                                'equipo', 
                                'descripcion', // <--- Agregado aquí
                                DB::raw('SUM(cantidad) as total_cantidad'), 
                                DB::raw('MAX(activo_fijo) as ejemplo_activo_fijo')
                             )
                             ->groupBy('equipo', 'descripcion') // <--- Agregado aquí (Obligatorio en SQL estricto)
                             ->orderBy('total_cantidad', 'desc')
                             ->get();
        } else {
            // MODO NORMAL: Trae todas las columnas (incluida descripcion)
            // Clonamos $query aquí por seguridad si vamos a usarla abajo de nuevo, 
            // aunque en este bloque else no es estrictamente necesario, es buena práctica.
            $equipos = (clone $query)->orderBy('created_at', 'desc')->get();
        }

        // 4. Estadísticas (Estas consultas son independientes, pero si quieres que respeten filtros
        // deberías basarlas también en $query, aunque aquí las dejé globales como las tenías)
        $stats = [
            'activos' => Equipo::where('estado', 'Activo')->count(),
            'mantenimiento' => Equipo::where('estado', 'En Mantenimiento')->count(),
            'total_departamentos' => Equipo::distinct('departamento')->count('departamento'),
            'nuevos_mes' => Equipo::whereMonth('fecha_ingreso', now()->month)
                                  ->whereYear('fecha_ingreso', now()->year)
                                  ->count(),
        ];

        // 5. Obtener SOLO descripciones filtradas (Para un datalist o filtro en la vista)
        // Usamos (clone $query) para aplicar los mismos filtros de arriba
        $descripcion = (clone $query)->distinct()->pluck('descripcion');

        return view('reportes.indexreportes', compact(
            'equipos',
            'condiciones',
            'estados',
            'departamentos',
            'categorias',
            'stats',
            'descripcion', // Ahora enviamos la colección de descripciones filtradas
        ));
    }
}