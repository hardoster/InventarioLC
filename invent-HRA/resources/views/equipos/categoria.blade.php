@extends('layouts.app')

@section('title', $nombreEquipo . ' - Sistema de Inventario')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <div class="flex items-center mb-2">
                        <a href="{{ route('equipos.por_tipo') }}" 
                           class="text-blue-600 hover:text-blue-800 mr-3 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Tipos de Equipos
                        </a>
                        <span class="text-gray-400">/</span>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $nombreEquipo }}</h1>
                    <p class="text-gray-600">Equipos de este tipo</p>
                </div>
                <a href="{{ route('equipos.index') }}" 
                   class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 transition-colors duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Inventario</span>
                </a>
            </div>
        </div>

        <!-- Estadísticas del Tipo -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-6">
                <p class="text-sm font-medium text-gray-600 mb-1">Total en {{ $nombreEquipo }}</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalTipo }}</p>
            </div>
            <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-6">
                <p class="text-sm font-medium text-gray-600 mb-1">Activos en {{ $nombreEquipo }}</p>
                <p class="text-2xl font-bold text-gray-900">{{ $activosTipo }}</p>
            </div>
            <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-6">
                <p class="text-sm font-medium text-gray-600 mb-1">Valor de {{ $nombreEquipo }}</p>
                <p class="text-2xl font-bold text-gray-900">${{ number_format($valorTipo, 2) }}</p>
            </div>
        </div>

        <!-- Lista de Equipos -->
        <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-8">
            <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-100">
                <div class="flex items-center">
                    <div class="w-1 h-8 bg-blue-500 rounded-full mr-4"></div>
                    <h2 class="text-2xl font-bold text-gray-900">Equipos ({{ $equipos->total() }})</h2>
                </div>
                <div class="text-sm text-gray-500">
                    Página {{ $equipos->currentPage() }} de {{ $equipos->lastPage() }}
                </div>
            </div>

            @if($equipos->isEmpty())
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <p class="text-gray-500 text-lg">No hay equipos en esta categoría</p>
            </div>
            @else
            <div class="space-y-4">
                @foreach($equipos as $equipo)
                <div class="rounded-2xl border-2 border-gray-100 hover:border-blue-200 p-6 transition-all duration-300 bg-white">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center mb-3">
                                <h3 class="text-lg font-semibold text-gray-900 mr-3">{{ $equipo->equipo }}</h3>
                                <span class="px-3 py-1 rounded-full text-xs font-medium 
                                    @if($equipo->estado == 'Activo') bg-green-100 text-green-800
                                    @elseif($equipo->estado == 'En Mantenimiento') bg-orange-100 text-orange-800
                                    @elseif($equipo->estado == 'Asignado') bg-blue-100 text-blue-800
                                    @elseif($equipo->estado == 'Inactivo') bg-gray-100 text-gray-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ $equipo->estado }}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                                <div class="space-y-1">
                                    <p><span class="font-medium">Serial:</span> {{ $equipo->serial ?? 'N/A' }}</p>
                                    <p><span class="font-medium">Activo Fijo:</span> {{ $equipo->activo_fijo ?? 'N/A' }}</p>
                                    <p><span class="font-medium">Responsable:</span> {{ $equipo->responsable }}</p>
                                </div>
                                <div class="space-y-1">
                                    <p><span class="font-medium">Departamento:</span> {{ $equipo->departamento }}</p>
                                    <p><span class="font-medium">Sucursal:</span> {{ $equipo->sucursal }}</p>
                                    <p><span class="font-medium">Modelo:</span> {{ $equipo->modelo ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex space-x-2 ml-4">
                            <a href="{{ route('equipos.show', $equipo) }}" 
                               class="p-2 text-gray-400 hover:text-blue-500 transition-colors duration-300"
                               title="Ver detalles">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('equipos.edit', $equipo) }}" 
                               class="p-2 text-gray-400 hover:text-green-500 transition-colors duration-300"
                               title="Editar">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Paginación -->
            @if($equipos->hasPages())
            <div class="mt-8">
                {{ $equipos->links() }}
            </div>
            @endif
            @endif
        </div>
    </div>
</div>
@endsection