<?php

/**
 * Modelo Producto
 * 
 * Representa un producto en el sistema de gestión con funcionalidades
 * de cálculo automático de IVA y manejo de precios.
 * 
 * @package App\Models
 * @author Sistema de Gestión
 * @version 1.0.0
 * @since 2024-09-16
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase Producto
 * 
 * Modelo Eloquent que representa la tabla 'productos' en la base de datos.
 * Incluye funcionalidades para:
 * - Cálculo automático de precios con IVA
 * - Relaciones con facturas
 * - Formateo de campos numéricos
 * 
 * @property int $id Identificador único del producto
 * @property string $producto Nombre del producto
 * @property int $cantidad Cantidad en inventario
 * @property float $precio_base Precio base sin IVA
 * @property float $iva_porcentaje Porcentaje de IVA aplicable
 * @property float $precio_con_iva Precio final con IVA incluido
 * @property \Carbon\Carbon $created_at Fecha de creación
 * @property \Carbon\Carbon $updated_at Fecha de última actualización
 */
class Producto extends Model
{
    use HasFactory;

    /**
     * Campos que pueden ser asignados masivamente
     * 
     * Define qué campos pueden ser llenados mediante asignación masiva
     * para proteger contra vulnerabilidades de asignación masiva.
     * 
     * @var array
     */
    protected $fillable = [
        'producto',         // Nombre del producto
        'cantidad',         // Cantidad en inventario
        'precio_base',      // Precio base sin IVA
        'iva_porcentaje',   // Porcentaje de IVA
        'precio_con_iva'    // Precio con IVA (calculado automáticamente)
    ];

    /**
     * Conversión de tipos para los atributos
     * 
     * Define cómo deben ser convertidos los atributos cuando se
     * recuperan de la base de datos o se asignan al modelo.
     * 
     * @var array
     */
    protected $casts = [
        'precio_base' => 'decimal:2',      // Decimal con 2 decimales
        'iva_porcentaje' => 'decimal:2',   // Decimal con 2 decimales
        'precio_con_iva' => 'decimal:2',   // Decimal con 2 decimales
    ];

    /**
     * Relación uno a muchos con facturas
     * 
     * Un producto puede estar asociado a múltiples facturas.
     * Esta relación permite obtener todas las facturas que incluyen este producto.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function facturas()
    {
        return $this->hasMany(Factura::class, 'id_producto');
    }

    /**
     * Calcula y actualiza el precio con IVA
     * 
     * Método público para recalcular el precio con IVA basado en
     * el precio base actual y el porcentaje de IVA.
     * 
     * @return float El precio calculado con IVA
     */
    public function calcularPrecioConIva()
    {
        $this->precio_con_iva = $this->precio_base * (1 + ($this->iva_porcentaje / 100));
        return $this->precio_con_iva;
    }

    /**
     * Accessor para obtener el monto del IVA
     * 
     * Calcula y retorna únicamente el monto del IVA (sin el precio base).
     * Se puede acceder como $producto->monto_iva
     * 
     * @return float Monto del IVA calculado
     */
    public function getMontoIvaAttribute()
    {
        return $this->precio_base * ($this->iva_porcentaje / 100);
    }

    /**
     * Método boot del modelo
     * 
     * Se ejecuta cuando el modelo es inicializado. Aquí se definen
     * los eventos del modelo que se ejecutan automáticamente.
     * 
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * Evento 'saving'
         * 
         * Se ejecuta antes de guardar el modelo (tanto en creación como actualización).
         * Calcula automáticamente el precio con IVA antes de guardar en la base de datos.
         */
        static::saving(function ($producto) {
            // Calcular precio con IVA automáticamente
            $producto->precio_con_iva = $producto->precio_base * (1 + ($producto->iva_porcentaje / 100));
        });
    }
}
