@extends('layouts.app')

@section('title', 'Equipos por agotarse - Sistema de Inventario')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Equipos por agotarse</h1>
                    <p class="text-gray-600">Vista organizada del inventario por agotarse</p>
                </div>
                <a href="{{ route('equipos.index') }}" 
                   class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 transition-colors duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Volver al Inventario</span>
                </a>
            </div>
        </div>

        <!-- Estadísticas Rápidas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-6">
                <p class="text-sm font-medium text-gray-600 mb-1">Total Equipos</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalEquipos }}</p>
            </div>
            <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-6">
                <p class="text-sm font-medium text-gray-600 mb-1">Equipos Activos</p>
                <p class="text-2xl font-bold text-gray-900">{{ $equiposActivos }}</p>
            </div>
            <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-6">
                <p class="text-sm font-medium text-gray-600 mb-1">Total Tipos</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalTipos }}</p>
            </div>
        </div>

        <!-- Grid de Tipos -->
        <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 pb-6 border-b border-gray-100 gap-4">
                <div class="flex items-center">
                    <div class="w-1 h-8 bg-blue-500 rounded-full mr-4"></div>
                    <h2 class="text-2xl font-bold text-gray-900">Tipos de Equipos Disponibles</h2>
                </div>
                
                <!-- Barra de Búsqueda -->
                <div class="relative w-full md:w-96">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" 
                           id="searchTipos" 
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out" 
                           placeholder="Buscar tipo de equipo...">
                </div>
            </div>

            @if($equiposGroup->isEmpty())
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <p class="text-gray-500 text-lg">No hay tipos de equipos registrados</p>
            </div>
            @else
            <div id="tiposGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($equiposGroup as $item)
                <a href="{{ route('equipos.detalle_tipo', $item->equipo) }}" 
                   class="tipo-card group block p-6 rounded-2xl border-2 border-gray-100 hover:border-blue-200 hover:shadow-sm transition-all duration-300"
                   data-nombre="{{ strtolower($item->equipo) }}">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-xl bg-blue-50 border-2 border-blue-100 group-hover:bg-blue-100 transition-colors duration-300 mr-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-300 tipo-nombre">
                                {{ $item->equipo }}
                            </h3>
                        </div>
                        <span class="px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $item->total }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 ml-16">Ver todos los equipos de este tipo</p>
                </a>
                @endforeach
            </div>
            
            <!-- Mensaje No Resultados -->
            <div id="noResults" class="hidden text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <p class="text-gray-500 text-lg">No se encontraron tipos de equipos que coincidan con tu búsqueda</p>
            </div>
            @endif
        </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchTipos');
    const tiposGrid = document.getElementById('tiposGrid');
    const noResults = document.getElementById('noResults');
    
    if (searchInput && tiposGrid) {
        const cards = tiposGrid.getElementsByClassName('tipo-card');
        
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase().trim();
            let hasVisibleCards = false;
            
            Array.from(cards).forEach(card => {
                const nombre = card.dataset.nombre;
                if (nombre.includes(searchTerm)) {
                    card.style.display = ''; // Restaurar display original (block/flex)
                    hasVisibleCards = true;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Mostrar/ocultar mensaje de no resultados
            if (hasVisibleCards) {
                noResults.classList.add('hidden');
            } else {
                noResults.classList.remove('hidden');
            }
        });
    }
});
</script>

        <!-- Resumen por Estados -->
        <div class="mt-8 bg-white rounded-3xl shadow-xs border border-gray-200 p-8">
            <div class="flex items-center mb-6 pb-4 border-b border-gray-100">
                <div class="w-1 h-8 bg-green-500 rounded-full mr-4"></div>
                <h2 class="text-xl font-bold text-gray-900">Resumen por Estados</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @php
                    $estados = [
                        'Activo' => ['color' => 'green', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        'Inactivo' => ['color' => 'gray', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        'En Mantenimiento' => ['color' => 'orange', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        'Asignado' => ['color' => 'blue', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                        'Dado de Baja' => ['color' => 'red', 'icon' => 'M6 18L18 6M6 6l12 12'],
                    ];
                @endphp
                @foreach($estados as $estado => $data)
                <div class="text-center p-4 rounded-2xl border-2 border-{{ $data['color'] }}-100 bg-{{ $data['color'] }}-50">
                    <svg class="w-8 h-8 text-{{ $data['color'] }}-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $data['icon'] }}"></path>
                    </svg>
                    <p class="text-sm font-medium text-{{ $data['color'] }}-800">{{ $estado }}</p>
                    <p class="text-lg font-bold text-{{ $data['color'] }}-900">
                        {{ \App\Models\Equipo::where('estado', $estado)->count() }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection