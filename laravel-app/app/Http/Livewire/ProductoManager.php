<?php

/**
 * Componente Livewire para la gestión de productos
 * 
 * Este componente maneja todas las operaciones CRUD (Crear, Leer, Actualizar, Eliminar)
 * para los productos del sistema, incluyendo el cálculo automático de IVA.
 * 
 * @package App\Http\Livewire
 * @author Sistema de Gestión
 * @version 1.0.0
 * @since 2024-09-16
 */

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;

/**
 * Clase ProductoManager
 * 
 * Gestiona la interfaz de usuario para productos con funcionalidades de:
 * - Listado de productos
 * - Creación de nuevos productos
 * - Edición de productos existentes
 * - Eliminación de productos
 * - Cálculo automático de precios con IVA
 */
class ProductoManager extends Component
{
    // Propiedades públicas del componente
    
    /** @var \Illuminate\Database\Eloquent\Collection Colección de productos */
    public $productos;
    
    /** @var string Nombre del producto */
    public $producto = '';
    
    /** @var int Cantidad en inventario */
    public $cantidad = 0;
    
    /** @var float Precio base sin IVA */
    public $precio_base = 0;
    
    /** @var float Porcentaje de IVA (por defecto 15%) */
    public $iva_porcentaje = 15.00;
    
    /** @var float Precio calculado con IVA incluido */
    public $precio_con_iva = 0;
    
    /** @var int|null ID del producto en edición (null si es creación) */
    public $editingId = null;

    /**
     * Reglas de validación para los campos del formulario
     * 
     * @var array
     */
    protected $rules = [
        'producto' => 'required|string|max:255',           // Nombre obligatorio, máximo 255 caracteres
        'cantidad' => 'required|integer|min:0',            // Cantidad obligatoria, entero positivo
        'precio_base' => 'required|numeric|min:0',         // Precio obligatorio, numérico positivo
        'iva_porcentaje' => 'required|numeric|min:0|max:100', // IVA obligatorio, entre 0 y 100%
    ];

    /**
     * Método que se ejecuta al inicializar el componente
     * Carga la lista inicial de productos
     * 
     * @return void
     */
    public function mount()
    {
        $this->loadProductos();
    }

    /**
     * Carga todos los productos desde la base de datos
     * 
     * @return void
     */
    public function loadProductos()
    {
        $this->productos = Producto::all();
    }

    /**
     * Guarda un producto (nuevo o actualización)
     * 
     * Valida los datos del formulario y procede a crear un nuevo producto
     * o actualizar uno existente según el estado de $editingId
     * 
     * @return void
     */
    public function save()
    {
        // Validar datos según las reglas definidas
        $this->validate();

        // Preparar datos para guardar
        $data = [
            'producto' => $this->producto,
            'cantidad' => (int)$this->cantidad,
            'precio_base' => (float)$this->precio_base,
            'iva_porcentaje' => (float)$this->iva_porcentaje,
        ];

        try {
            if ($this->editingId) {
                // Modo edición: actualizar producto existente
                $producto = Producto::find($this->editingId);
                if ($producto) {
                    $producto->update($data);
                    $this->editingId = null;
                    session()->flash('message', 'Producto actualizado exitosamente.');
                }
            } else {
                // Modo creación: crear nuevo producto
                Producto::create($data);
                session()->flash('message', 'Producto creado exitosamente.');
            }

            // Limpiar formulario y recargar lista
            $this->resetForm();
            $this->loadProductos();
        } catch (\Exception $e) {
            // Manejo de errores con mensaje al usuario
            session()->flash('error', 'Error al guardar el producto: ' . $e->getMessage());
        }
    }

    /**
     * Prepara un producto para edición
     * 
     * Carga los datos del producto seleccionado en el formulario
     * para permitir su modificación
     * 
     * @param int $id ID del producto a editar
     * @return void
     */
    public function edit($id)
    {
        try {
            $producto = Producto::find($id);
            if ($producto) {
                // Cargar datos del producto en el formulario
                $this->editingId = $id;
                $this->producto = $producto->producto;
                $this->cantidad = $producto->cantidad;
                $this->precio_base = $producto->precio_base;
                $this->iva_porcentaje = $producto->iva_porcentaje;
                
                // Recalcular precio con IVA
                $this->calcularPrecioConIva();
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error al cargar el producto: ' . $e->getMessage());
        }
    }

    /**
     * Elimina un producto de la base de datos
     * 
     * @param int $id ID del producto a eliminar
     * @return void
     */
    public function delete($id)
    {
        try {
            $producto = Producto::find($id);
            if ($producto) {
                $producto->delete();
                $this->loadProductos();
                session()->flash('message', 'Producto eliminado exitosamente.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar el producto: ' . $e->getMessage());
        }
    }

    /**
     * Cancela la operación de edición
     * 
     * Limpia el formulario y vuelve al modo de creación
     * 
     * @return void
     */
    public function cancel()
    {
        $this->resetForm();
    }

    /**
     * Reinicia todos los campos del formulario a sus valores por defecto
     * 
     * @return void
     */
    public function resetForm()
    {
        $this->producto = '';
        $this->cantidad = 0;
        $this->precio_base = 0;
        $this->iva_porcentaje = 15.00;
        $this->precio_con_iva = 0;
        $this->editingId = null;
        $this->resetValidation(); // Limpia errores de validación
    }

    /**
     * Hook de Livewire que se ejecuta cuando cambia el precio base
     * 
     * Recalcula automáticamente el precio con IVA
     * 
     * @return void
     */
    public function updatedPrecioBase()
    {
        $this->calcularPrecioConIva();
    }

    /**
     * Hook de Livewire que se ejecuta cuando cambia el porcentaje de IVA
     * 
     * Recalcula automáticamente el precio con IVA
     * 
     * @return void
     */
    public function updatedIvaPorcentaje()
    {
        $this->calcularPrecioConIva();
    }

    /**
     * Calcula el precio final incluyendo el IVA
     * 
     * Fórmula: precio_con_iva = precio_base * (1 + iva_porcentaje/100)
     * 
     * @return void
     */
    public function calcularPrecioConIva()
    {
        if ($this->precio_base && $this->iva_porcentaje >= 0) {
            $this->precio_con_iva = $this->precio_base * (1 + ($this->iva_porcentaje / 100));
        } else {
            $this->precio_con_iva = 0;
        }
    }

    /**
     * Renderiza la vista del componente
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.producto-manager');
    }
}
