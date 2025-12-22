@extends('layouts.app')

@section('title', $equipo->equipo . ' - Sistema de Inventario')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50/30 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Detalles del Equipo</h1>
                    <p class="text-gray-600">Información completa del equipo en el inventario</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('equipos.index') }}" 
                       class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 transition-colors duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Volver al Inventario</span>
                    </a>
                    <a href="{{ route('equipos.edit', $equipo) }}" 
                       class="bg-blue-500 text-white px-6 py-2 rounded-2xl font-medium hover:bg-blue-600 transition-all duration-300 flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        <span>Editar</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Información Principal -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Header del Equipo -->
                <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-8">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex items-center">
                            <div class="p-4 rounded-2xl bg-blue-50 border-2 border-blue-100 mr-4">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">{{ $equipo->equipo }}</h2>
                                <p class="text-gray-600">{{ $equipo->categoria }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-end space-y-2">
                            <span class="px-4 py-2 rounded-full text-sm font-medium 
                                @if($equipo->estado == 'Activo') bg-green-100 text-green-800
                                @elseif($equipo->estado == 'En Mantenimiento') bg-orange-100 text-orange-800
                                @elseif($equipo->estado == 'Inactivo') bg-gray-100 text-gray-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $equipo->estado }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-medium 
                                @if($equipo->condicion == 'Excelente') bg-green-100 text-green-800
                                @elseif($equipo->condicion == 'Bueno') bg-blue-100 text-blue-800
                                @elseif($equipo->condicion == 'Regular') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $equipo->condicion }}
                            </span>
                        </div>
                    </div>

                    @if($equipo->descripcion)
                    <div class="bg-gray-50 rounded-2xl p-4 border border-gray-200">
                        <p class="text-gray-700">{{ $equipo->descripcion }}</p>
                    </div>
                    @endif
                </div>

                <!-- Información Detallada -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Información Técnica -->
                    <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-8">
                        <div class="flex items-center mb-6 pb-4 border-b border-gray-100">
                            <div class="w-1 h-8 bg-blue-500 rounded-full mr-4"></div>
                            <h3 class="text-xl font-bold text-gray-900">Información Técnica</h3>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Modelo:</span>
                                <span class="text-gray-900">{{ $equipo->modelo ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Número de Serie:</span>
                                <span class="text-gray-900 font-mono">{{ $equipo->serial ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Activo Fijo:</span>
                                <span class="text-gray-900 font-mono">{{ $equipo->activo_fijo ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Cantidad:</span>
                                <span class="text-gray-900">{{ $equipo->cantidad }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Información de Ubicación -->
                    <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-8">
                        <div class="flex items-center mb-6 pb-4 border-b border-gray-100">
                            <div class="w-1 h-8 bg-green-500 rounded-full mr-4"></div>
                            <h3 class="text-xl font-bold text-gray-900">Ubicación</h3>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Responsable:</span>
                                <span class="text-gray-900">{{ $equipo->responsable }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Departamento:</span>
                                <span class="text-gray-900">{{ $equipo->departamento }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Sucursal:</span>
                                <span class="text-gray-900">{{ $equipo->sucursal }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Información de Fechas -->
                    <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-8">
                        <div class="flex items-center mb-6 pb-4 border-b border-gray-100">
                            <div class="w-1 h-8 bg-purple-500 rounded-full mr-4"></div>
                            <h3 class="text-xl font-bold text-gray-900">Fechas</h3>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Fecha de Ingreso:</span>
                                <span class="text-gray-900">{{ $equipo->fecha_ingreso->format('d/m/Y') }}</span>
                            </div>
                            @if($equipo->fecha_salida)
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Fecha de Salida:</span>
                                <span class="text-gray-900">{{ $equipo->fecha_salida->format('d/m/Y') }}</span>
                            </div>
                            @endif
                            @if($equipo->fecha_compra)
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Fecha de Compra:</span>
                                <span class="text-gray-900">{{ $equipo->fecha_compra->format('d/m/Y') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Información Financiera -->
                    <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-8">
                        <div class="flex items-center mb-6 pb-4 border-b border-gray-100">
                            <div class="w-1 h-8 bg-orange-500 rounded-full mr-4"></div>
                            <h3 class="text-xl font-bold text-gray-900">Información Financiera</h3>
                        </div>
                        <div class="space-y-4">
                            @if($equipo->precio_compra)
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Precio de Compra:</span>
                                <span class="text-gray-900 font-mono">${{ number_format($equipo->precio_compra, 2) }}</span>
                            </div>
                            @endif
                            @if($equipo->valor_actual)
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Valor Actual:</span>
                                <span class="text-gray-900 font-mono">${{ number_format($equipo->valor_actual, 2) }}</span>
                            </div>
                            @endif
                            @if($equipo->antiguedad)
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Antigüedad:</span>
                                <span class="text-gray-900">{{ $equipo->antiguedad }} meses</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Información de Garantía y Soporte -->
                <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-8">
                    <div class="flex items-center mb-6 pb-4 border-b border-gray-100">
                        <div class="w-1 h-8 bg-red-500 rounded-full mr-4"></div>
                        <h3 class="text-xl font-bold text-gray-900">Garantía y Soporte</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Estado Garantía:</span>
                                <span class="px-3 py-1 rounded-full text-sm font-medium 
                                    @if($equipo->estado_garantia == 'Vigente') bg-green-100 text-green-800
                                    @elseif($equipo->estado_garantia == 'Vencida') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $equipo->estado_garantia }}
                                </span>
                            </div>
                            @if($equipo->garantia)
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Garantía:</span>
                                <span class="text-gray-900">{{ $equipo->garantia }} meses</span>
                            </div>
                            @endif
                        </div>
                        <div class="space-y-4">
                            @if($equipo->tecnico)
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Técnico:</span>
                                <span class="text-gray-900">{{ $equipo->tecnico }}</span>
                            </div>
                            @endif
                            @if($equipo->ticket)
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Ticket:</span>
                                <span class="text-gray-900 font-mono">{{ $equipo->ticket }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar - Información Adicional -->
            <div class="space-y-8">
                
                <!-- Resumen de Estado -->
                <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-8">
                    <div class="flex items-center mb-6 pb-4 border-b border-gray-100">
                        <div class="w-1 h-8 bg-purple-500 rounded-full mr-4"></div>
                        <h3 class="text-xl font-bold text-gray-900">Resumen</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="text-center p-4 rounded-2xl bg-blue-50 border-2 border-blue-100">
                            <p class="text-sm text-blue-600 font-medium">Categoría</p>
                            <p class="text-lg font-bold text-blue-800">{{ $equipo->categoria }}</p>
                        </div>
                        <div class="text-center p-4 rounded-2xl bg-green-50 border-2 border-green-100">
                            <p class="text-sm text-green-600 font-medium">Condición</p>
                            <p class="text-lg font-bold text-green-800">{{ $equipo->condicion }}</p>
                        </div>
                        <div class="text-center p-4 rounded-2xl bg-orange-50 border-2 border-orange-100">
                            <p class="text-sm text-orange-600 font-medium">Estado</p>
                            <p class="text-lg font-bold text-orange-800">{{ $equipo->estado }}</p>
                        </div>
                    </div>
                </div>

                <!-- Acciones Rápidas -->
                <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-8">
                    <div class="flex items-center mb-6 pb-4 border-b border-gray-100">
                        <div class="w-1 h-8 bg-green-500 rounded-full mr-4"></div>
                        <h3 class="text-xl font-bold text-gray-900">Acciones</h3>
                    </div>
                    <div class="space-y-3">
                        <a href="{{ route('equipos.edit', $equipo) }}" 
                           class="w-full flex items-center space-x-3 p-4 rounded-2xl border-2 border-gray-100 hover:border-blue-200 transition-all duration-300 bg-blue-50">
                            <div class="p-2 rounded-xl bg-blue-100 border-2 border-blue-200">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-blue-700">Editar Equipo</span>
                        </a>
                        <a href="{{ route('equipos.index') }}" 
                           class="w-full flex items-center space-x-3 p-4 rounded-2xl border-2 border-gray-100 hover:border-gray-200 transition-all duration-300">
                            <div class="p-2 rounded-xl bg-gray-100 border-2 border-gray-200">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">Volver al Inventario</span>
                        </a>
                        <form action="{{ route('equipos.destroy', $equipo) }}" method="POST" 
                              onsubmit="return confirm('¿Está seguro de que desea eliminar este equipo? Esta acción no se puede deshacer.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full flex items-center space-x-3 p-4 rounded-2xl border-2 border-gray-100 hover:border-red-200 transition-all duration-300 text-left">
                                <div class="p-2 rounded-xl bg-red-100 border-2 border-red-200">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </div>
                                <span class="font-medium text-red-700">Eliminar Equipo</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Información del Sistema -->
                <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-8">
                    <div class="flex items-center mb-6 pb-4 border-b border-gray-100">
                        <div class="w-1 h-8 bg-gray-500 rounded-full mr-4"></div>
                        <h3 class="text-xl font-bold text-gray-900">Sistema</h3>
                    </div>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">ID:</span>
                            <span class="text-gray-900 font-mono">#{{ $equipo->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Creado:</span>
                            <span class="text-gray-900">{{ $equipo->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Actualizado:</span>
                            <span class="text-gray-900">{{ $equipo->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection