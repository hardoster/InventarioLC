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
    <div class="flex items-center space-x-3">
        <button id="scanButton" 
                class="bg-amber-500 text-white px-6 py-3 rounded-2xl font-medium hover:bg-amber-600 transition-all duration-300 flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1l-1 1h2l-1-1V4zM4 12H3m1-1V4a2 2 0 012-2h10a2 2 0 012 2v7m-6 7l1 1v-3m-1 4h2l-1-1v-2m-9 1h7M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h2v2H7V7zm3 0h2v2h-2V7zm3 0h2v2h-2V7zm-9 3h2v2H7v-2zm3 0h2v2h-2v-2zm3 0h2v2h-2v-2zm-6 3h2v2H7v-2zm3 0h2v2h-2v-2zm3 0h2v2h-2v-2z"></path>
            </svg>
            <span>Escanear QR</span>
        </button>
        <a href="{{ route('equipos.create') }}" 
           class="bg-blue-500 text-white px-6 py-3 rounded-2xl font-medium hover:bg-blue-600 transition-all duration-300 flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Nuevo Equipo</span>
        </a>
    </div>
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
                <th>Tecnico</th>
                <th>Departamento</th>
                <th>Sucursal</th>
                <th>Condición</th>
                <th>Cantidad</th>
                <th>Ubicación</th>
                
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
                <td>{{ $equipo->tecnico }}</td>
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
                <td>{{ $equipo->cantidad ?? 'N/A' }}</td>
                <td>{{ $equipo->ubicacion ?? 'N/A' }}</td>
                
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
                        <a href="{{ route('reportes.index') }}" class="w-full flex items-center space-x-3 p-3 rounded-2xl border-2 border-gray-100 hover:border-blue-200 transition-all duration-300">
                            <div class="p-2 rounded-xl bg-blue-50 border-2 border-blue-100">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">Generar Reporte</span>
                        </a>

                        <a href="{{ route('equipos.por_tipo') }}" 
                        class="w-full flex items-center space-x-3 p-3 rounded-2xl border-2 border-gray-100 hover:border-blue-200 transition-all duration-300">
                            <div class="p-2 rounded-xl bg-amber-50 border-2 border-amber-100">
                                <svg   class="w-5 h-5 text-amber-600"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">Ver por tipos</span>
                        </a>

                         <a href="{{ route('equipos.por_existencias') }}" 
                        class="w-full flex items-center space-x-3 p-3 rounded-2xl border-2 border-gray-100 hover:border-blue-200 transition-all duration-300">
                            <div class="p-2 rounded-xl bg-red-50 border-2 border-red-100">
                                <svg class="w-5 h-5 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">Equipos por agotarse</span>
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
    // --- QR Scanner Integration ---
    let html5QrCode;
    const scannerModal = document.getElementById('scannerModal');
    const scanButton = document.getElementById('scanButton');
    const closeScanner = document.getElementById('closeScanner');

    function startScanner() {
        // Check if browser supports camera access (Secure Context check)
        if (!window.isSecureContext && window.location.hostname !== 'localhost') {
            alert("Acceso a la cámara bloqueado: El navegador requiere HTTPS para acceder a la cámara cuando no es 'localhost'. Estás usando: " + window.location.origin);
            return;
        }

        scannerModal.classList.remove('hidden');
        scannerModal.classList.add('flex');
        
        // Initialize the library
        if (!html5QrCode) {
            html5QrCode = new Html5Qrcode("reader");
        }

        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            const table = $('#equiposTable').DataTable();
            table.search(decodedText).draw();
            stopScanner();
        };
        
        const config = { fps: 10, qrbox: { width: 300, height: 50 } };
        
        // Request permissions first by getting cameras
        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                // If cameras found, start the background one or the first one
                html5QrCode.start({ facingMode: "environment" }, config, qrCodeSuccessCallback)
                    .catch((err) => {
                        console.error("Error starting scanner:", err);
                        alert("Error al iniciar cámara: " + err);
                        stopScanner();
                    });
            } else {
                alert("No se detectaron cámaras en este dispositivo.");
                stopScanner();
            }
        }).catch(err => {
            console.error("Permission error:", err);
            alert("Error de permisos o cámara no disponible: " + err);
            stopScanner();
        });
    }

    function stopScanner() {
        if (html5QrCode && html5QrCode.isScanning) {
            html5QrCode.stop().then(() => {
                html5QrCode.clear();
                scannerModal.classList.add('hidden');
                scannerModal.classList.remove('flex');
            }).catch(err => console.error("Error stopping scanner:", err));
        } else {
            scannerModal.classList.add('hidden');
            scannerModal.classList.remove('flex');
        }
    }

    scanButton.addEventListener('click', startScanner);
    closeScanner.addEventListener('click', stopScanner);
    
    // Close on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !scannerModal.classList.contains('hidden')) {
            stopScanner();
        }
    });
});
</script>

<!-- Scanner Modal -->
<div id="scannerModal" class="hidden fixed inset-0 z-50 overflow-auto bg-black bg-opacity-75 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl relative">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-900 flex items-center">
                <svg class="w-6 h-6 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1l-1 1h2l-1-1V4zM4 12H3m1-1V4a2 2 0 012-2h10a2 2 0 012 2v7m-6 7l1 1v-3m-1 4h2l-1-1v-2m-9 1h7M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Escaneando Código
            </h3>
            <button id="closeScanner" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <div id="reader" style="width: 100%;" class="rounded-2xl overflow-hidden border-2 border-dashed border-gray-200"></div>
        
        <p class="mt-4 text-sm text-gray-500 text-center">
            Apunta tu cámara hacia un código QR o código de barras de un equipo.
        </p>
    </div>
</div>
@endsection