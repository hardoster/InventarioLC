<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_ingreso',
        'fecha_salida',
        'cantidad',
        'tecnico',
        'ticket',
        'equipo',
        'responsable',
        'departamento',
        'sucursal',
        'categoria',
        'descripcion',
        'modelo',
        'serial',
        'activo_fijo',
        'fecha_compra',
        'garantia',
        'precio_compra',
        'condicion',
        'antiguedad',
        'valor_actual',
        'estado_garantia',
        'estado',
    ];

    protected $casts = [
        'fecha_ingreso' => 'date',
        'fecha_salida' => 'date',
        'fecha_compra' => 'date',
        'precio_compra' => 'decimal:2',
        'valor_actual' => 'decimal:2',
    ];




 // Scope para búsquedas
    public function scopeSearch($query, $search)
    {
        return $query->where('equipo', 'like', "%{$search}%")
                    ->orWhere('serial', 'like', "%{$search}%")
                    ->orWhere('activo_fijo', 'like', "%{$search}%")
                    ->orWhere('responsable', 'like', "%{$search}%")
                    ->orWhere('modelo', 'like', "%{$search}%")
                    ->orWhere('ticket', 'like', "%{$search}%");
    }

}