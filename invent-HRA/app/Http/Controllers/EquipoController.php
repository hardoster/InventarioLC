<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ReportesController;

class EquipoController extends Controller
{
    public function index()
{
    // Estadísticas para el dashboard
    // Estadísticas para el dashboard
    $totalEquipos = Equipo::sum('cantidad');
    $equiposActivos = Equipo::where('estado', 'Activo')->sum('cantidad');
    $enMantenimiento = Equipo::where('estado', 'En Mantenimiento')->sum('cantidad');
    $inactivos = Equipo::where('estado', 'Inactivo')->sum('cantidad');
    $asignados = Equipo::where('estado', 'Asignado')->sum('cantidad');
    $dadosDeBaja = Equipo::where('estado', 'Dado de Baja')->sum('cantidad');
    
    // Calcular valor total del inventario
    $valorTotal = Equipo::sum('valor_actual') ?? 0;

    $equipos = Equipo::orderBy('created_at', 'desc')->get();
    
    return view('equipos.index', compact(
        'equipos',
        'totalEquipos',
        'equiposActivos',
        'enMantenimiento',
        'inactivos',
        'asignados',
        'dadosDeBaja',
        'valorTotal'
    ));
}

   public function create()
{
    // Valores predefinidos para los selects
    $condiciones = ['Nuevo', 'Bueno', 'Regular', 'Malo', 'Obsoleto'];
    $estadosGarantia = ['Vigente', 'Vencida', 'No Aplica'];
    $estados = ['Activo', 'Inactivo', 'En Mantenimiento', 'Dado de Baja','Asignado'];
    $departamentos = ['TI', 'Administración', 'Contabilidad', 'Recursos Humanos', 'Tienda', 'Marketing'];
    $sucursales = ['Cau Escalon', 'Cau Proceres','LC San Luis', 'LC Proceres', 'LC Merliot', 'Centro Historico','LC Las Palmas',
     'LC Santa Rosa de Lima', 
     'LC San jacinto', 'San Marino', 'LC USULUTAN', 'LC Ahuachapán', 'LC San Martin'];
    $categorias = ['Computadoras', 'Impresoras', 'Servidores', 'Redes', 'Telefonía', 'Electrónicos'];

    return view('equipos.create', compact(
        'condiciones', 
        'estadosGarantia', 
        'estados', 
        'departamentos',
        'sucursales',
        'categorias'
    ));
}

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // DEBUG: Inicio de creación
    \Log::info('=== STORE INICIADO - CREAR EQUIPO ===', [
        'timestamp' => now(),
        'request_data' => $request->all()
    ]);

    // Validación STRICTA
    try {
        $validatedData = $request->validate([
            'fecha_ingreso' => 'required|date',
            'fecha_salida' => 'nullable|date|after_or_equal:fecha_ingreso',
            'cantidad' => 'required|integer|min:1',
            'tecnico' => 'nullable|string|max:100',
            'ticket' => 'nullable|string|max:50',
            'equipo' => 'required|string|max:200',
            'responsable' => 'required|string|max:100',
            'departamento' => 'required|string|max:100',
            'sucursal' => 'required|string|max:100',
            'categoria' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'modelo' => 'nullable|string|max:100',
            'serial' => 'nullable|string|max:100',
            'activo_fijo' => 'nullable|string|max:100',
            'fecha_compra' => 'nullable|date',
            'garantia' => 'nullable|string|max:50',
            'precio_compra' => 'nullable|numeric|min:0',
            'condicion' => 'required|string|in:Nuevo,Bueno,Regular,Malo,Obsoleto',
            'estado' => 'required|string|in:Activo,Inactivo,En Mantenimiento,Dado de Baja,Asignado', // Agregué 'Asignado'
        ]);

        \Log::info('✅ Validación pasada', ['validated_data' => $validatedData]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('❌ Error de validación en store', [
            'errors' => $e->errors(),
            'request' => $request->except('_token'),
            'condicion_enviada' => $request->condicion ?? 'No enviada',
            'estado_enviado' => $request->estado ?? 'No enviado'
        ]);
        
        return redirect()->back()
            ->withErrors($e->errors())
            ->withInput();
    }

    try {
        DB::beginTransaction();
        \Log::info('🚀 Iniciando transacción para crear equipo');

        // Crear equipo con datos validados
        $equipo = new Equipo($validatedData);
        \Log::info('📝 Modelo Equipo creado', [
            'attributes' => $equipo->getAttributes(),
            'fillable' => $equipo->getFillable()
        ]);

        

        \Log::info('💾 Intentando guardar equipo en BD...');
        $saved = $equipo->save();
        
        if (!$saved) {
            throw new \Exception('El método save() retornó false');
        }

        DB::commit();
        
        \Log::info('✅ EQUIPO CREADO EXITOSAMENTE', [
            'id' => $equipo->id,
            'equipo' => $equipo->equipo,
            'responsable' => $equipo->responsable,
            'created_at' => $equipo->created_at
        ]);

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo creado exitosamente.');

    } catch (\Exception $e) {
        DB::rollBack();
        
        \Log::error('💥 ERROR CRÍTICO al crear equipo', [
            'error_message' => $e->getMessage(),
            'error_file' => $e->getFile(),
            'error_line' => $e->getLine(),
            'error_trace' => $e->getTraceAsString(),
            'request_data' => $request->except('_token'),
            'validated_data' => $validatedData ?? 'No validado',
            'equipo_attributes' => $equipo->getAttributes() ?? 'Modelo no creado'
        ]);

        // Mensajes específicos por tipo de error
        $mensajeError = 'Error al crear el equipo: ' . $e->getMessage();
        
        if (str_contains($e->getMessage(), 'condicion')) {
            $mensajeError = 'Error: La condición debe ser una de: Nuevo, Bueno, Regular, Malo, Obsoleto';
        } elseif (str_contains($e->getMessage(), 'estado')) {
            $mensajeError = 'Error: El estado debe ser una de: Activo, Inactivo, En Mantenimiento, Dado de Baja, Asignado';
        } elseif (str_contains($e->getMessage(), 'Duplicate entry')) {
            $mensajeError = 'Error: Ya existe un equipo con ese número de serie o activo fijo';
        }

        \Log::info('🔄 Redirigiendo con error: ' . $mensajeError);

        return redirect()->back()
            ->with('error', $mensajeError)
            ->withInput();
    } finally {
        \Log::info('=== STORE FINALIZADO ===');
    }
}
    /**
     * Display the specified resource.
     */
    public function show(Equipo $equipo)
    {
        return view('equipos.show', compact('equipo'));
    }

   public function edit(Equipo $equipo)
{
    $condiciones = ['Nuevo', 'Bueno', 'Regular', 'Malo', 'Obsoleto'];
    $estadosGarantia = ['Vigente', 'Vencida', 'No Aplica'];
    $estados = ['Activo', 'Inactivo', 'En Mantenimiento', 'Dado de Baja','Asignado'];
    $departamentos = ['TI', 'Administración', 'Contabilidad', 'Recursos Humanos', 'Tienda', 'Marketing'];
    $sucursales = ['CAU ESCALON', 'CAU PROCERES', 'LC PROCERES', 'LC MERLIOT', 'LC SAN LUIS', 'LC Las Palmas' ,
    'LC AHUACHAPAN' ,'Centro Historico','LC Santa Rosa de lima', 'LC Pericentro apopa',
    'LC Chalatenango', 'San Marino', 'LC USULUTAN', 'LC San Martin', 'LC San jacinto'];
    $categorias = ['Computadoras', 'Impresoras', 'Servidores', 'Redes', 'Telefonía', 'Electrónicos'];

    return view('equipos.edit', compact(
        'equipo',
        'condiciones', 
        'estadosGarantia', 
        'estados', 
        'departamentos',
        'sucursales',
        'categorias'
    ));
} 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipo $equipo)
{
    // DEBUG 1: Ver qué llega
   \Log::info('=== UPDATE INICIADO ===', [
       'equipo_id' => $equipo->id,
       'request_data' => $request->all()
    ]);

    // Validación básica
    $validated = $request->validate([
        'fecha_ingreso' => 'required|date',
        'cantidad' => 'required|integer|min:1',
        'equipo' => 'required|string|max:200',
        'responsable' => 'required|string|max:100',
        'departamento' => 'required|string|max:100',
        'sucursal' => 'required|string|max:100',
        'categoria' => 'required|string|max:100',
        'condicion' => 'required|string|in:Nuevo,Bueno,Regular,Malo,Obsoleto',
        'estado' => 'required|string|in:Activo,Inactivo,En Mantenimiento,Dado de Baja,Asignado',
    ]);

   \Log::info('Validación pasada', ['validated' => $validated]);

    try {
        DB::beginTransaction();

        // DEBUG 2: Ver datos actuales
   \Log::info('Datos antes de actualizar', ['antes' => $equipo->toArray()]);

        // Actualizar solo campos específicos
        $equipo->fecha_ingreso = $request->fecha_ingreso;
        $equipo->fecha_salida = $request->fecha_salida;
        $equipo->cantidad = $request->cantidad;
        $equipo->tecnico = $request->tecnico;
        $equipo->ticket = $request->ticket;
        $equipo->equipo = $request->equipo;
        $equipo->responsable = $request->responsable;
        $equipo->departamento = $request->departamento;
        $equipo->sucursal = $request->sucursal;
        $equipo->categoria = $request->categoria;
        $equipo->descripcion = $request->descripcion;
        $equipo->modelo = $request->modelo;
        $equipo->serial = $request->serial;
        $equipo->activo_fijo = $request->activo_fijo;
        $equipo->fecha_compra = $request->fecha_compra;
        $equipo->garantia = $request->garantia;
        $equipo->precio_compra = $request->precio_compra;
        $equipo->condicion = $request->condicion;
        $equipo->estado = $request->estado;

        // DEBUG 3: Ver cambios
   \Log::info('Cambios detectados', ['cambios' => $equipo->getDirty()]);

     
        $saved = $equipo->save();

        // DEBUG 4: Ver resultado del save
   \Log::info('Resultado save()', ['saved' => $saved, 'equipo_id' => $equipo->id]);

        DB::commit();

        // DEBUG 5: Ver datos después
   \Log::info('Datos después de actualizar', ['despues' => $equipo->fresh()->toArray()]);

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo actualizado exitosamente.');

    } catch (\Exception $e) {
        DB::rollBack();

   \Log::error('Error al actualizar equipo', [
         'id' => $equipo->id,
         'error' => $e->getMessage(),
         'stack_trace' => $e->getTraceAsString(),
         'request' => $request->all()
     ]);

        return redirect()->back()
            ->with('error', 'Error al actualizar el equipo: ' . $e->getMessage())
            ->withInput();
    }
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo)
    {
        try {
            $equipo->delete();
            
            return redirect()->route('equipos.index')
                ->with('success', 'Equipo eliminado exitosamente.');
                
        } catch (\Exception $e) {
            return redirect()->route('equipos.index')
                ->with('error', 'Error al eliminar el equipo: ' . $e->getMessage());
        }
    }

    /**
     * Buscar equipos
     */
    public function search(Request $request)
{
    $search = $request->get('search');
    
    $equipos = Equipo::search($search)
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    // Recargar las estadísticas para el dashboard
    // Recargar las estadísticas para el dashboard
    $totalEquipos = Equipo::sum('cantidad');
    $equiposActivos = Equipo::where('estado', 'Activo')->sum('cantidad');
    $enMantenimiento = Equipo::where('estado', 'En Mantenimiento')->sum('cantidad');
    $inactivos = Equipo::where('estado', 'Inactivo')->sum('cantidad');
    $asignados = Equipo::where('estado', 'Asignado')->sum('cantidad');
    $dadosDeBaja = Equipo::where('estado', 'Dado de Baja')->sum('cantidad');
    $valorTotal = Equipo::sum('valor_actual') ?? 0;

    return view('equipos.index', compact(
        'equipos',
        'search',
        'totalEquipos',
        'equiposActivos',
        'enMantenimiento',
        'inactivos',
        'asignados',
        'dadosDeBaja',
        'valorTotal'
    ));
}



/**
 * Mostrar equipos agrupados por categorías
 */
/**
 * Mostrar equipos agrupados por nombre de equipo (tipo)
 */
public function porEquipos()
{
    // Obtener todos los nombres de equipos únicos con conteo
    $equiposGroup = Equipo::select('equipo')
        ->selectRaw('SUM(cantidad) as total')
        ->groupBy('equipo')
        ->orderBy('equipo')
        ->get();
    
    // Obtener estadísticas generales
    $totalEquipos = Equipo::count();
    $equiposActivos = Equipo::where('estado', 'Activo')->count();
    $valorTotal = Equipo::sum('valor_actual') ?? 0;
    
    return view('equipos.categorias', compact(
        'equiposGroup',
        'totalEquipos',
        'equiposActivos',
        'valorTotal'
    ));
}












/**
 * Mostrar equipos de un nombre/tipo específico
 */
public function detalleEquipo($nombreEquipo)
{
    // Validar que el tipo de equipo exista
    $equiposExistentes = Equipo::distinct()->pluck('equipo')->toArray();
    
    if (!in_array($nombreEquipo, $equiposExistentes)) {
        return redirect()->route('equipos.por_tipo')
            ->with('error', 'Tipo de equipo no encontrado');
    }
    
    // Obtener equipos de este tipo
    $equipos = Equipo::where('equipo', $nombreEquipo)
        ->orderBy('created_at', 'desc')
        ->paginate(20);
    
    // Estadísticas de este tipo
    $totalTipo = Equipo::where('equipo', $nombreEquipo)->sum('cantidad');
    $activosTipo = Equipo::where('equipo', $nombreEquipo)
        ->where('estado', 'Activo')
        ->sum('cantidad');
    $valorTipo = Equipo::where('equipo', $nombreEquipo)
        ->sum('valor_actual') ?? 0;
    
    return view('equipos.categoria', compact(
        'equipos',
        'nombreEquipo',
        'totalTipo',
        'activosTipo',
        'valorTipo'
    ));
}


public function porExistencias()
{
$equiposGroup = Equipo::select('equipo')
    ->selectRaw('SUM(cantidad) as total')
    ->where('estado', 'Activo') 
    ->groupBy('equipo')
    ->having('total', '<=', 2) 
    ->orderBy('equipo')
    ->get();
    
    $totalEquipos = Equipo::where('cantidad', '<=', 2)->count();
    $equiposActivos = Equipo::where('estado', 'Activo')
                            ->where('cantidad', '<=', 2)
                            ->count();
    $totalTipos = $equiposGroup->count();

    return view('equipos.Existencias', compact(
        'equiposGroup',
        'totalEquipos',
        'equiposActivos',
        'totalTipos',
       
    ));
}




















}