<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_ingreso');
            $table->date('fecha_salida')->nullable();
            $table->integer('cantidad')->default(1);
            $table->string('tecnico')->nullable();
            $table->string('ticket');
            $table->string('equipo');
            $table->string('responsable');
            $table->string('departamento');
            $table->string('sucursal');
            $table->string('categoria');
            $table->text('descripcion')->nullable();
            $table->string('modelo')->nullable();
            $table->string('serial');
            $table->string('activo_fijo');
            $table->date('fecha_compra')->nullable();
            $table->string('garantia')->nullable();
            $table->decimal('precio_compra', 10, 2)->nullable();
            $table->enum('condicion', ['Nuevo', 'Bueno', 'Regular', 'Malo', 'Obsoleto'])->default('Bueno');
            $table->integer('antiguedad')->nullable()->comment('En meses');
            $table->decimal('valor_actual', 10, 2)->nullable();
            $table->enum('estado_garantia', ['Vigente', 'Vencida', 'No Aplica'])->default('No Aplica');
            $table->enum('estado', ['Activo', 'Inactivo', 'En Mantenimiento', 'Dado de Baja'])->default('Activo');
            $table->timestamps();
        });

         // Valores predefinidos para los selects
    $condiciones = ['Nuevo', 'Bueno', 'Regular', 'Malo', 'Obsoleto'];
    $estadosGarantia = ['Vigente', 'Vencida', 'No Aplica'];
    $estados = ['Activo', 'Inactivo', 'En Mantenimiento', 'Dado de Baja','Asignado'];
    $departamentos = ['TI', 'Administración', 'Contabilidad', 'Recursos Humanos', 'Ventas', 'Marketing'];
    $sucursales = ['Cau Escalon', 'Cau Proceres', 'LC Proceres'];
    $categorias = ['Computadoras', 'Impresoras', 'Servidores', 'Redes', 'Telefonía', 'Electrónicos'];
    }

    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};