@extends('layouts.app')

@section('title', 'Editar Equipo - Sistema de Inventario')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50/30 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Editar Equipo</h1>
                    <p class="text-gray-600">Actualice la información del equipo en el inventario</p>
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

        <!-- Form Section -->
        <div class="bg-white rounded-3xl shadow-xs border border-gray-200 p-8">
            <!-- Form Header -->
            <div class="flex items-center mb-8 pb-6 border-b border-gray-100">
                <div class="w-1 h-8 bg-orange-500 rounded-full mr-4"></div>
                <h2 class="text-2xl font-bold text-gray-900">Editando: {{ $equipo->equipo }}</h2>
            </div>




            <form action="{{ route('equipos.update', $equipo) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-8">
                    
                    <!-- Sección: Información Básica -->
                    <div class="rounded-2xl border-2 border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <div class="w-1 h-6 bg-blue-500 rounded-full mr-3"></div>
                            Información Básica
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Equipo -->
                            <div>
                                <label for="equipo" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tipo de Equipo *
                                </label>
                                <input type="text" 
                                       name="equipo" 
                                       id="equipo"
                                       required
                                       value="{{ old('equipo', $equipo->equipo) }}"
                                       class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300"
                                       placeholder="Ej: Laptop, Impresora, Servidor">
                            </div>

                            <!-- Categoría -->
                            <div>
                                <label for="categoria" class="block text-sm font-medium text-gray-700 mb-2">
                                    Categoría *
                                </label>
                                <select name="categoria" 
                                        id="categoria"
                                        required
                                        class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300">
                                    <option value="">Seleccione una categoría</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria }}" {{ old('categoria', $equipo->categoria) == $categoria ? 'selected' : '' }}>
                                            {{ $categoria }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Modelo -->
                            <div>
                                <label for="modelo" class="block text-sm font-medium text-gray-700 mb-2">
                                    Modelo
                                </label>
                                <input type="text" 
                                       name="modelo" 
                                       id="modelo"
                                       value="{{ old('modelo', $equipo->modelo) }}"
                                       class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300"
                                       placeholder="Ej: ThinkPad X1, LaserJet Pro">
                            </div>

                            <!-- Descripción -->
                            <div class="md:col-span-2">
                                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">
                                    Descripción
                                </label>
                                <textarea name="descripcion" 
                                          id="descripcion"
                                          rows="3"
                                          class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300"
                                          placeholder="Descripción detallada del equipo...">{{ old('descripcion', $equipo->descripcion) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Identificación -->
                    <div class="rounded-2xl border-2 border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <div class="w-1 h-6 bg-purple-500 rounded-full mr-3"></div>
                            Identificación
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Serial -->
                            <div>
                                <label for="serial" class="block text-sm font-medium text-gray-700 mb-2">
                                    Número de Serie
                                </label>
                                <input type="text" 
                                       name="serial" 
                                       id="serial"
                                       value="{{ old('serial', $equipo->serial) }}"
                                       class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300"
                                       placeholder="Número único de serie">
                            </div>

                            <!-- Activo Fijo -->
                            <div>
                                <label for="activo_fijo" class="block text-sm font-medium text-gray-700 mb-2">
                                    Activo Fijo
                                </label>
                                <input type="text" 
                                       name="activo_fijo" 
                                       id="activo_fijo"
                                       value="{{ old('activo_fijo', $equipo->activo_fijo) }}"
                                       class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300"
                                       placeholder="Código de activo fijo">
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Ubicación y Responsable -->
                    <div class="rounded-2xl border-2 border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <div class="w-1 h-6 bg-orange-500 rounded-full mr-3"></div>
                            Ubicación y Responsable
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Responsable -->
                            <div>
                                <label for="responsable" class="block text-sm font-medium text-gray-700 mb-2">
                                    Responsable *
                                </label>
                                <input type="text" 
                                       name="responsable" 
                                       id="responsable"
                                       required
                                       value="{{ old('responsable', $equipo->responsable) }}"
                                       class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300"
                                       placeholder="Nombre del responsable">
                            </div>

                            <!-- Departamento -->
                            <div>
                                <label for="departamento" class="block text-sm font-medium text-gray-700 mb-2">
                                    Departamento *
                                </label>
                                <select name="departamento" 
                                        id="departamento"
                                        required
                                        class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300">
                                    <option value="">Seleccione departamento</option>
                                    @foreach($departamentos as $departamento)
                                        <option value="{{ $departamento }}" {{ old('departamento', $equipo->departamento) == $departamento ? 'selected' : '' }}>
                                            {{ $departamento }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sucursal -->
                            <div>
                                <label for="sucursal" class="block text-sm font-medium text-gray-700 mb-2">
                                    Sucursal *
                                </label>
                                <select name="sucursal" 
                                        id="sucursal"
                                        required
                                        class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300">
                                    <option value="">Seleccione sucursal</option>
                                    @foreach($sucursales as $sucursal)
                                        <option value="{{ $sucursal }}" {{ old('sucursal', $equipo->sucursal) == $sucursal ? 'selected' : '' }}>
                                            {{ $sucursal }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Cantidad -->
                            <div>
                                <label for="cantidad" class="block text-sm font-medium text-gray-700 mb-2">
                                    Cantidad *
                                </label>
                                <input type="number" 
                                       name="cantidad" 
                                       id="cantidad"
                                       required
                                       min="1"
                                       value="{{ old('cantidad', $equipo->cantidad) }}"
                                       class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300">
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Fechas y Estado -->
                    <div class="rounded-2xl border-2 border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <div class="w-1 h-6 bg-green-500 rounded-full mr-3"></div>
                            Fechas y Estado
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Fecha Ingreso -->
                            <div>
                                <label for="fecha_ingreso" class="block text-sm font-medium text-gray-700 mb-2">
                                    Fecha de Ingreso *
                                </label>
                                <input type="date" 
                                       name="fecha_ingreso" 
                                       id="fecha_ingreso"
                                       required
                                       value="{{ old('fecha_ingreso', $equipo->fecha_ingreso->format('Y-m-d')) }}"
                                       class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300">
                            </div>

                            <!-- Fecha Salida -->
                            <div>
                                <label for="fecha_salida" class="block text-sm font-medium text-gray-700 mb-2">
                                    Fecha de Salida
                                </label>
                                <input type="date" 
                                       name="fecha_salida" 
                                       id="fecha_salida"
                                       value="{{ old('fecha_salida', $equipo->fecha_salida ? $equipo->fecha_salida->format('Y-m-d') : '') }}"
                                       class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300">
                            </div>

                            <!-- Fecha Compra -->
                            <div>
                                <label for="fecha_compra" class="block text-sm font-medium text-gray-700 mb-2">
                                    Fecha de Compra
                                </label>
                                <input type="date" 
                                       name="fecha_compra" 
                                       id="fecha_compra"
                                       value="{{ old('fecha_compra', $equipo->fecha_compra ? $equipo->fecha_compra->format('Y-m-d') : '') }}"
                                       class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300">
                            </div>

                            <!-- Condición -->
                            <div>
                                <label for="condicion" class="block text-sm font-medium text-gray-700 mb-2">
                                    Condición *
                                </label>
                                <select name="condicion" 
                                        id="condicion"
                                        required
                                        class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300">
                                    <option value="">Seleccione condición</option>
                                    @foreach($condiciones as $condicion)
                                        <option value="{{ $condicion }}" {{ old('condicion', $equipo->condicion) == $condicion ? 'selected' : '' }}>
                                            {{ $condicion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Estado -->
                            <div>
                                <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">
                                    Estado *
                                </label>
                                <select name="estado" 
                                        id="estado"
                                        required
                                        class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300">
                                    <option value="">Seleccione estado</option>
                                    @foreach($estados as $estado)
                                        <option value="{{ $estado }}" {{ old('estado', $equipo->estado) == $estado ? 'selected' : '' }}>
                                            {{ $estado }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Estado Garantía -->
                            <div>
                                <label for="estado_garantia" class="block text-sm font-medium text-gray-700 mb-2">
                                    Estado Garantía
                                </label>
                                <select name="estado_garantia" 
                                        id="estado_garantia"
                                        class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300">
                                    @foreach($estadosGarantia as $estadoGarantia)
                                        <option value="{{ $estadoGarantia }}" {{ old('estado_garantia', $equipo->estado_garantia) == $estadoGarantia ? 'selected' : '' }}>
                                            {{ $estadoGarantia }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Información Financiera -->
                    <div class="rounded-2xl border-2 border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <div class="w-1 h-6 bg-blue-500 rounded-full mr-3"></div>
                            Información Financiera
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Precio Compra -->
                            <div>
                                <label for="precio_compra" class="block text-sm font-medium text-gray-700 mb-2">
                                    Precio de Compra
                                </label>
                                <input type="number" 
                                       name="precio_compra" 
                                       id="precio_compra"
                                       step="0.01"
                                       min="0"
                                       value="{{ old('precio_compra', $equipo->precio_compra) }}"
                                       class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300"
                                       placeholder="0.00">
                            </div>

                            <!-- Valor Actual -->
                            <div>
                                <label for="valor_actual" class="block text-sm font-medium text-gray-700 mb-2">
                                    Valor Actual
                                </label>
                                <input type="number" 
                                       name="valor_actual" 
                                       id="valor_actual"
                                       step="0.01"
                                       min="0"
                                       value="{{ old('valor_actual', $equipo->valor_actual) }}"
                                       class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300"
                                       placeholder="0.00">
                            </div>

                            <!-- Garantía -->
                            <div>
                                <label for="garantia" class="block text-sm font-medium text-gray-700 mb-2">
                                    Garantía (meses)
                                </label>
                                <input type="number" 
                                       name="garantia" 
                                       id="garantia"
                                       min="0"
                                       value="{{ old('garantia', $equipo->garantia) }}"
                                       class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300"
                                       placeholder="Ej: 12, 24, 36">
                            </div>

                            <!-- Antigüedad -->
                            <div>
                                <label for="antiguedad" class="block text-sm font-medium text-gray-700 mb-2">
                                    Antigüedad (meses)
                                </label>
                                <input type="number" 
                                       name="antiguedad" 
                                       id="antiguedad"
                                       min="0"
                                       value="{{ old('antiguedad', $equipo->antiguedad) }}"
                                       class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300">
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Soporte Técnico -->
                    <div class="rounded-2xl border-2 border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <div class="w-1 h-6 bg-purple-500 rounded-full mr-3"></div>
                            Soporte Técnico
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Técnico -->
                            <div>
                                <label for="tecnico" class="block text-sm font-medium text-gray-700 mb-2">
                                    Técnico Asignado
                                </label>
                                <input type="text" 
                                       name="tecnico" 
                                       id="tecnico"
                                       value="{{ old('tecnico', $equipo->tecnico) }}"
                                       class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300"
                                       placeholder="Nombre del técnico">
                            </div>

                            <!-- Ticket -->
                            <div>
                                <label for="ticket" class="block text-sm font-medium text-gray-700 mb-2">
                                    Número de Ticket
                                </label>
                                <input type="text" 
                                       name="ticket" 
                                       id="ticket"
                                       value="{{ old('ticket', $equipo->ticket) }}"
                                       class="w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-blue-300 focus:ring-0 transition-all duration-300"
                                       placeholder="Número de ticket/soporte">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-100">
                  

                    <!-- Save/Cancel Buttons -->
                    <div class="flex space-x-4">
                        <a href="{{ route('equipos.index') }}" 
                           class="px-6 py-3 rounded-2xl border-2 border-gray-300 text-gray-700 font-medium hover:border-gray-400 transition-all duration-300">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="bg-blue-500 text-white px-8 py-3 rounded-2xl font-medium hover:bg-blue-600 transition-all duration-300 flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Actualizar Equipo</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection