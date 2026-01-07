<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de Inventario | Sistema de Equipos Informáticos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .glassmorphism {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .filter-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.1);
        }
        
        .title-decorator {
            position: relative;
            padding-left: 20px;
        }
        
        .title-decorator::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 6px;
            border-radius: 3px;
            background: linear-gradient(to bottom, #3b82f6, #8b5cf6);
        }
        
        .result-table {
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .result-table th {
            background-color: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .result-table td, .result-table th {
            padding: 12px 16px;
        }
        
        .result-table tr:last-child td {
            border-bottom: none;
        }
        
        /* Personalización de scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* DataTables Customization */
        .dataTables_wrapper .dataTables_length select {
            padding-right: 30px !important;
            border-radius: 0.5rem;
            border-color: #e2e8f0;
        }
        
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 0.5rem;
            border-color: #e2e8f0;
            padding: 0.5rem;
            margin-left: 0.5rem;
        }

        .dt-buttons .dt-button {
            border-radius: 0.5rem !important;
            padding: 0.5rem 1rem !important;
            font-weight: 500 !important;
            border: 1px solid #e2e8f0 !important;
            background: white !important;
            color: #374151 !important;
            transition: all 0.2s !important;
        }

        .dt-buttons .dt-button:hover {
            background: #f3f4f6 !important;
        }
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
</head>
<body class="bg-gradient-to-br from-slate-50 to-blue-50/30 min-h-screen">
    <!-- Contenedor principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Encabezado de la vista -->
        <div class="mb-10 no-print">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Reportes de Inventario</h1>
                    <p class="text-gray-600 mt-2">Genera reportes personalizados del inventario de equipos informáticos</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Usuario actual</p>
                        <p class="font-medium text-gray-900">Harrison Aguilar</p>
                    </div>
                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold">
                        HA
                    </div>
                </div>
            </div>
            
            <!-- Breadcrumb -->
            <div class="flex items-center text-sm text-gray-500 mb-8">
                <a href="{{ route('equipos.index') }}" class="hover:text-blue-600">Inicio</a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <span class="text-blue-600 font-medium">Reportes</span>
            </div>
        </div>
        
        <!-- Sección de filtros -->
        <!-- Sección de filtros -->
        <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-8 mb-8 no-print">
            <h2 class="text-2xl font-bold text-gray-900 title-decorator mb-8">Configurar Reporte</h2>
            
            <form action="{{ route('reportes.index') }}" method="GET">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
                    <!-- Filtro 1: Fechas -->
                    <div class="filter-card bg-gradient-to-br from-white to-blue-50/50 rounded-2xl border-2 border-gray-100 hover:border-blue-200 p-6 transition-all duration-300">
                        <div class="flex items-center mb-4">
                            <div class="h-10 w-10 rounded-xl bg-blue-100 flex items-center justify-center mr-4">
                                <i class="fas fa-calendar-alt text-blue-600"></i>
                            </div>
                            <h3 class="font-bold text-gray-900 text-lg">Rango de Fechas</h3>
                        </div>
                        <p class="text-gray-600 mb-6 text-sm">Selecciona el período para el reporte</p>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de inicio</label>
                                <div class="relative">
                                    <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}" class="w-full rounded-xl border border-gray-300 py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de fin</label>
                                <div class="relative">
                                    <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}" class="w-full rounded-xl border border-gray-300 py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filtro 2: Estado y Condición -->
                    <div class="filter-card bg-gradient-to-br from-white to-green-50/50 rounded-2xl border-2 border-gray-100 hover:border-green-200 p-6 transition-all duration-300">
                        <div class="flex items-center mb-4">
                            <div class="h-10 w-10 rounded-xl bg-green-100 flex items-center justify-center mr-4">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                            <h3 class="font-bold text-gray-900 text-lg">Estado y Condición</h3>
                        </div>
                        <p class="text-gray-600 mb-6 text-sm">Filtra por estado operativo y condición física</p>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Estado del equipo</label>
                                <select name="estado" class="w-full rounded-xl border border-gray-300 py-3 px-4 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <option value="">Todos los estados</option>
                                    @foreach($estados as $estado)
                                        <option value="{{ $estado }}" {{ request('estado') == $estado ? 'selected' : '' }}>{{ $estado }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Condición física</label>
                                <select name="condicion" class="w-full rounded-xl border border-gray-300 py-3 px-4 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <option value="">Todas las condiciones</option>
                                    @foreach($condiciones as $condicion)
                                        <option value="{{ $condicion }}" {{ request('condicion') == $condicion ? 'selected' : '' }}>{{ $condicion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filtro 3: Ubicación y Categoría -->
                    <div class="filter-card bg-gradient-to-br from-white to-purple-50/50 rounded-2xl border-2 border-gray-100 hover:border-purple-200 p-6 transition-all duration-300">
                        <div class="flex items-center mb-4">
                            <div class="h-10 w-10 rounded-xl bg-purple-100 flex items-center justify-center mr-4">
                                <i class="fas fa-location-dot text-purple-600"></i>
                            </div>
                            <h3 class="font-bold text-gray-900 text-lg">Ubicación y Tipo</h3>
                        </div>
                        <p class="text-gray-600 mb-6 text-sm">Filtra por ubicación y categoría de equipo</p>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Departamento</label>
                                <select name="departamento" class="w-full rounded-xl border border-gray-300 py-3 px-4 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                    <option value="">Todos los departamentos</option>
                                    @foreach($departamentos as $depto)
                                        <option value="{{ $depto }}" {{ request('departamento') == $depto ? 'selected' : '' }}>{{ $depto }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Categoría de equipo</label>
                                <select name="categoria" class="w-full rounded-xl border border-gray-300 py-3 px-4 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                    <option value="">Todas las categorías</option>
                                    @foreach($categorias as $cat)
                                        <option value="{{ $cat }}" {{ request('categoria') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Botones de acción -->
                <div class="flex flex-wrap justify-between items-center pt-6 border-t border-gray-100">
                    <div class="mb-4 md:mb-0 flex items-center">
                        <button type="submit" class="py-3 px-6 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg flex items-center mr-4">
                            <i class="fas fa-filter mr-2"></i>
                            Generar Reporte
                        </button>

                        <div class="flex items-center">
                            <input type="checkbox" id="categorias" name="printtypes" value="1" {{ request('printtypes') ? 'checked' : '' }} class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                            <label for="categorias" class="ml-2 text-sm font-medium text-gray-700 cursor-pointer">
                                Ver por categorías
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('reportes.index') }}" class="py-3 px-6 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-all duration-300 flex items-center">
                            <i class="fas fa-redo-alt mr-2"></i>
                            Restablecer Filtros
                        </a>
                        
                        <!-- Botón guardar configuración (simulado por ahora) -->
                        <button type="button" class="py-3 px-6 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-all duration-300 flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            Guardar Configuración
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Sección de resultados -->
        <div id="printableArea" class="bg-white rounded-3xl shadow-xs border border-gray-200 p-8">
            <div class="flex flex-wrap justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900 title-decorator">Resultados del Reporte</h2>
            </div>
            
            <!-- Estadísticas resumidas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100/50 border border-blue-200 rounded-2xl p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-700 mb-1">Equipos Activos</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['activos'] }}</p>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-laptop text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-green-50 to-green-100/50 border border-green-200 rounded-2xl p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-green-700 mb-1">En Mantenimiento</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['mantenimiento'] }}</p>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-green-100 flex items-center justify-center">
                            <i class="fas fa-tools text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-purple-50 to-purple-100/50 border border-purple-200 rounded-2xl p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-700 mb-1">Total Departamentos</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_departamentos'] }}</p>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-building text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-orange-50 to-orange-100/50 border border-orange-200 rounded-2xl p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-orange-700 mb-1">Nuevos este mes</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['nuevos_mes'] }}</p>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-orange-100 flex items-center justify-center">
                            <i class="fas fa-calendar-plus text-orange-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tabla de resultados -->
            <div class="overflow-x-auto rounded-2xl border border-gray-200 p-4">
                <table id="reportesTable" class="min-w-full result-table display responsive nowrap" style="width:100%">
                    <thead>
                        <tr class="bg-gray-50">
                            @if(request('printtypes'))
                                <th class="text-left text-sm font-semibold text-gray-700 py-4 px-6 rounded-tl-2xl">Equipo</th>
                                <th class="text-left text-sm font-semibold text-gray-700 py-4 px-6">Cantidad Total</th>
                                <th class="text-left text-sm font-semibold text-gray-700 py-4 px-6 rounded-tr-2xl">Activo Fijo (Ref)</th>
                                <th class="text-left text-sm font-semibold text-gray-700 py-4 px-6 rounded-tr-2xl">Descripcion</th>
                            @else
                                <th class="text-left text-sm font-semibold text-gray-700 py-4 px-6 rounded-tl-2xl">Equipo</th>
                                <th class="text-left text-sm font-semibold text-gray-700 py-4 px-6">Cantidad</th>
                                <th class="text-left text-sm font-semibold text-gray-700 py-4 px-6">Serial</th>
                                <th class="text-left text-sm font-semibold text-gray-700 py-4 px-6">Activo Fijo</th>
                                <th class="text-left text-sm font-semibold text-gray-700 py-4 px-6">Ubicación</th>
                                <th class="text-left text-sm font-semibold text-gray-700 py-4 px-6">Estado</th>
                                <th class="text-left text-sm font-semibold text-gray-700 py-4 px-6 rounded-tr-2xl">Condición</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($equipos as $equipo)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            @if(request('printtypes'))
                                <td class="py-4 px-6">
                                    <div class="font-medium text-gray-900">{{ $equipo->equipo }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $equipo->total_cantidad }}</span>
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-500">{{ $equipo->ejemplo_activo_fijo ?? 'N/A' }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500">{{ $equipo->descripcion ?? 'N/A' }}</td>
                            @else
                                <td class="py-4 px-6">
                                    <div class="font-medium text-gray-900">{{ $equipo->equipo }}</div>
                                    <div class="text-sm text-gray-500">Modelo: {{ $equipo->modelo ?? 'N/A' }}</div>
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-500">{{ $equipo->cantidad }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500">{{ $equipo->serial ?? 'N/A' }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500">{{ $equipo->activo_fijo ?? 'N/A' }}</td>
                                <td class="py-4 px-6">
                                    <div class="text-sm text-gray-900">{{ $equipo->sucursal ?? 'N/A' }}</div>
                                    <div class="text-xs text-gray-500">{{ $equipo->departamento ?? 'N/A' }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    @php
                                        $estadoClass = match($equipo->estado) {
                                            'Activo' => 'bg-green-100 text-green-800',
                                            'Inactivo' => 'bg-red-100 text-red-800',
                                            'En Mantenimiento' => 'bg-yellow-100 text-yellow-800',
                                            'Dado de Baja' => 'bg-gray-100 text-gray-800',
                                            'Asignado' => 'bg-blue-100 text-blue-800',
                                            default => 'bg-gray-100 text-gray-800'
                                        };
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $estadoClass }}">{{ $equipo->estado }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $equipo->condicion }}</span>
                                </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ request('printtypes') ? '3' : '7' }}" class="py-8 text-center text-gray-500">
                                No se encontraron equipos con los filtros seleccionados.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Paginación y resumen -->
            <div class="flex flex-wrap justify-between items-center mt-8 pt-6 border-t border-gray-100">
                <div class="text-sm text-gray-500">
                    Reporte generado: <span class="font-medium text-gray-900">{{ now()->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>
        
        <!-- Pie de página -->
        <div class="mt-10 pt-8 border-t border-gray-200 text-center text-gray-500 text-sm no-print">
            <p>Sistema de Inventario de Equipos Informáticos • Usuario: Harrison Aguilar • © 2025</p>
            <p class="mt-2">El uso de esta aplicacion esta reservado exclusivamente para Harrison Aguilar</p>
        </div>
    </div>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#reportesTable').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel mr-2 text-green-500"></i> Excel',
                        className: 'dt-button'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf mr-2 text-red-500"></i> PDF',
                        className: 'dt-button'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print mr-2 text-blue-500"></i> Imprimir',
                        className: 'dt-button',
                        title: '',
                        customize: function ( win ) {
                            $(win.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<div style="text-align: center; margin-bottom: 20px;">' +
                                    '<h1 style="font-size: 24px; font-weight: bold; color: #1e3a8a;">Reporte de Inventario</h1>' +
                                    '<p style="font-size: 14px; color: #64748b;">Generado el: ' + new Date().toLocaleDateString() + '</p>' +
                                    '<p style="font-size: 14px; color: #64748b;">Sistema creado por Harrison Aguilar todos los derechos reservados © 2026</p>' +
                                    '</div>'
                                );
        
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( 'font-size', 'inherit' )
                                .css( 'width', '100%' )
                                .css( 'border-collapse', 'collapse' );
                                
                            // Estilo para encabezados
                            $(win.document.body).find('thead th')
                                .css('background-color', '#1e3a8a')
                                .css('color', 'white')
                                .css('padding', '10px')
                                .css('text-align', 'left');
                                
                            // Estilo para celdas
                            $(win.document.body).find('tbody td')
                                .css('padding', '8px')
                                .css('border-bottom', '1px solid #e2e8f0');
                                
                            // Estilo para filas pares
                            $(win.document.body).find('tbody tr:nth-child(even)')
                                .css('background-color', '#f8fafc');
                        }
                    }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });
        });
        
        // Simular fecha actual en los campos de fecha
        const today = new Date();
        const lastMonth = new Date();
        lastMonth.setMonth(today.getMonth() - 1);
        
        // Formatear fechas para input type="date"
        const formatDate = (date) => {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        };
        
        // Establecer fechas por defecto (último mes hasta hoy)
        // Solo si no tienen valor (para no sobrescribir lo que viene del request)
        const inputs = document.querySelectorAll('input[type="date"]');
        if (!inputs[0].value) inputs[0].value = formatDate(lastMonth);
        if (!inputs[1].value) inputs[1].value = formatDate(today);
    </script>
</body>
</html>