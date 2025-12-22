@extends('layouts.app')

@section('title', 'Dashboard - Sistema de Inventario')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
  

        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Bienvenido, Harrison</h1>
                    <p class="text-gray-600">Panel de control del sistema de inventario</p>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="bg-white rounded-2xl border-2 border-gray-100 px-4 py-2 text-sm font-medium text-gray-700">
                        {{ now()->format('d M, Y') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Stats Dashboard -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Equipos -->
            <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-6 transition-all duration-300 hover:shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-2xl bg-blue-50 border-2 border-blue-100 mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Equipos</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalEquipos ?? '0' }}</p>
                    </div>
                </div>
            </div>

            <!-- Equipos Activos -->
            <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-6 transition-all duration-300 hover:shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-2xl bg-green-50 border-2 border-green-100 mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>




                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Equipos Activos</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $equiposActivos ?? '0' }}</p>
                    </div>
                </div>
            </div>

            <!-- En Mantenimiento -->
            <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-6 transition-all duration-300 hover:shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-2xl bg-orange-50 border-2 border-orange-100 mr-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">En Mantenimiento</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $enMantenimiento ?? '0' }}</p>
                    </div>
                </div>
            </div>
            


<!-- Asignados -->
            <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-6 transition-all duration-300 hover:shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-2xl bg-orange-50 border-2 border-orange-100 mr-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Asignados</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $asignados ?? '0' }}</p>
                    </div>
                </div>
            </div>






            <!-- Valor Total Inventario -->
            <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-6 transition-all duration-300 hover:shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-2xl bg-purple-50 border-2 border-purple-100 mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v1m0 6v1m0 1v1m6-12h2m-10 0h2m-2 12h2m-2 4h2"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Valor Total</p>
                        <p class="text-2xl font-bold text-gray-900">${{ number_format($valorTotal ?? 0, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Lista de Equipos -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-8">
                    <!-- Header con barra lateral colorida -->
                    <div class="flex items-center mb-8 pb-4 border-b border-gray-100">
                        <div class="w-1 h-8 bg-blue-500 rounded-full mr-4"></div>
                        <h2 class="text-2xl font-bold text-gray-900">Inventario de Equipos</h2>
                    </div>

                    <!-- Barra de acciones -->
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Inventario de Equipos</h2>
        <p class="text-gray-600">Gestión completa del inventario</p>
    </div>
    <a href="{{ route('equipos.create') }}" 
       class="bg-blue-500 text-white px-6 py-3 rounded-2xl font-medium hover:bg-blue-600 transition-all duration-300 flex items-center space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        <span>Nuevo Equipo</span>
    </a>
</div>

<!-- Tabla con DataTables -->
<div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-6">
    <table id="equiposTable" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Equipo</th>
                <th>Serial</th>
                <th>Activo Fijo</th>
                <th>Acciones</th>
                <th>Estado</th>
                <th>Responsable</th>
                <th>Departamento</th>
                <th>Sucursal</th>
                <th>Condición</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($equipos as $equipo)
            <tr>
                <td>
                    <div class="font-medium text-gray-900">{{ $equipo->equipo }}</div>
                    <div class="text-sm text-gray-500">{{ $equipo->categoria }}</div>
                    @if($equipo->modelo)
                    <div class="text-xs text-gray-400">{{ $equipo->modelo }}</div>
                    @endif
                </td>
                <td>{{ $equipo->serial ?? 'N/A' }}</td>
                <td>{{ $equipo->activo_fijo ?? 'N/A' }}</td>
                <td>
                    <div class="flex space-x-2">
                        <a href="{{ route('equipos.show', $equipo) }}" 
                           class="p-1 text-gray-400 hover:text-blue-500 transition-colors duration-300"
                           title="Ver detalles">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </a>
                        <a href="{{ route('equipos.edit', $equipo) }}" 
                           class="p-1 text-gray-400 hover:text-green-500 transition-colors duration-300"
                           title="Editar">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('equipos.destroy', $equipo) }}" method="POST" class="inline"
                              onsubmit="return confirm('¿Eliminar este equipo?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="p-1 text-gray-400 hover:text-red-500 transition-colors duration-300"
                                    title="Eliminar">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
                   <td>
                    <span class="px-3 py-1 rounded-full text-xs font-medium 
                        @if($equipo->estado == 'Activo') bg-green-100 text-green-800
                        @elseif($equipo->estado == 'En Mantenimiento') bg-orange-100 text-orange-800
                        @elseif($equipo->estado == 'Asignado') bg-blue-100 text-blue-800
                        @elseif($equipo->estado == 'Inactivo') bg-gray-100 text-gray-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ $equipo->estado }}
                    </span>
                </td>
                <td>{{ $equipo->responsable }}</td>
                <td>{{ $equipo->departamento }}</td>
                <td>{{ $equipo->sucursal }}</td>
             
                <td>
                    <span class="px-2 py-1 rounded-full text-xs 
                        @if($equipo->condicion == 'Nuevo') bg-green-100 text-green-800
                        @elseif($equipo->condicion == 'Bueno') bg-blue-100 text-blue-800
                        @elseif($equipo->condicion == 'Regular') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ $equipo->condicion }}
                    </span>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


                </div>
            </div>

            <!-- Sidebar - Resumen Rápido -->
            <div class="space-y-8">
                <!-- Resumen por Estado -->
                <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-8">
                    <div class="flex items-center mb-6 pb-4 border-b border-gray-100">
                        <div class="w-1 h-8 bg-purple-500 rounded-full mr-4"></div>
                        <h2 class="text-xl font-bold text-gray-900">Resumen por Estado</h2>
                    </div>
                    <div class="space-y-4">
                        @php
                            $estados = [
                                'Activo' => ['color' => 'green', 'count' => $equiposActivos ?? 0],
                                'Asignado' => ['color' => 'blue', 'count' => $asignados ?? 0],
                                'En Mantenimiento' => ['color' => 'orange', 'count' => $enMantenimiento ?? 0],
                                'Inactivo' => ['color' => 'gray', 'count' => $inactivos ?? 0],
                                'Dado de Baja' => ['color' => 'red', 'count' => $dadosDeBaja ?? 0],
                            ];
                        @endphp
                        @foreach($estados as $estado => $data)
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">{{ $estado }}</span>
                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-{{ $data['color'] }}-100 text-{{ $data['color'] }}-800">
                                {{ $data['count'] }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Acciones Rápidas -->
                <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-8">
                    <div class="flex items-center mb-6 pb-4 border-b border-gray-100">
                        <div class="w-1 h-8 bg-green-500 rounded-full mr-4"></div>
                        <h2 class="text-xl font-bold text-gray-900">Acciones Rápidas</h2>
                    </div>
                    <div class="space-y-3">
                        <a href="{{ route('equipos.create') }}" class="w-full flex items-center space-x-3 p-3 rounded-2xl border-2 border-gray-100 hover:border-green-200 transition-all duration-300">
                            <div class="p-2 rounded-xl bg-green-50 border-2 border-green-100">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">Nuevo Equipo</span>
                        </a>
                        <a href="#" class="w-full flex items-center space-x-3 p-3 rounded-2xl border-2 border-gray-100 hover:border-blue-200 transition-all duration-300">
                            <div class="p-2 rounded-xl bg-blue-50 border-2 border-blue-100">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">Generar Reporte</span>
                        </a>

                        <a href="{{ route('equipos.por_tipo') }}" 
                        class="w-full flex items-center space-x-3 p-3 rounded-2xl border-2 border-gray-100 hover:border-blue-200 transition-all duration-300">
                            <div class="p-2 rounded-xl bg-blue-50 border-2 border-blue-100">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">Ver por tipos</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

















<script>
$(document).ready(function() {
    $('#equiposTable').DataTable({
        // Configuración en español
        language: {
            "decimal": "",
            "emptyTable": "No hay datos disponibles",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ equipos",
            "infoEmpty": "Mostrando 0 a 0 de 0 equipos",
            "infoFiltered": "(filtrado de _MAX_ equipos totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ equipos",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron equipos",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activar para ordenar ascendente",
                "sortDescending": ": activar para ordenar descendente"
            }
        },
        // Ordenar por la columna ID descendente (los más nuevos primero)
        order: [[0, 'desc']],
        // Mostrar 10, 25, 50, 100 registros por página
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        // Hacer responsive
        responsive: true,
        // Configuración adicional
        pageLength: 10,
        dom: '<"flex justify-between items-center mb-4"<"flex items-center"l><"flex items-center"f>>rt<"flex justify-between items-center mt-4"<"flex items-center"i><"flex items-center"p>>',
        initComplete: function() {
            // Personalizar el input de búsqueda
            $('.dataTables_filter input').addClass('px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-500');
            $('.dataTables_filter label').contents().filter(function() {
                return this.nodeType === 3; // Text nodes
            }).remove();
        }
    });
    
    // Estilos personalizados para DataTables
    $('.dataTables_length select').addClass('px-3 py-1 border rounded-lg');
    $('.dataTables_paginate .paginate_button').addClass('px-3 py-1 mx-1 rounded-lg border hover:bg-gray-100');
    $('.dataTables_paginate .paginate_button.current').addClass('bg-blue-500 text-white border-blue-500');
});
</script>
@endsection