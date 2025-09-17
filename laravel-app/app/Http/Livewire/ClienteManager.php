<?php

/**
 * Componente Livewire para la gestión de clientes
 * 
 * Este componente maneja todas las operaciones CRUD para los clientes del sistema,
 * proporcionando una interfaz intuitiva para la administración de la base de datos
 * de clientes de la empresa.
 * 
 * @package App\Http\Livewire
 * @author Sistema de Gestión
 * @version 1.0.0
 * @since 2024-09-16
 */

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cliente;

/**
 * Clase ClienteManager
 * 
 * Gestiona la interfaz de usuario para clientes con funcionalidades de:
 * - Listado completo de clientes
 * - Creación de nuevos registros de clientes
 * - Edición de información existente
 * - Eliminación de registros
 * - Validación de datos en tiempo real
 */
class ClienteManager extends Component
{
    // Propiedades públicas del componente
    
    /** @var \Illuminate\Database\Eloquent\Collection Colección de todos los clientes */
    public $clientes;
    
    /** @var string Código único del cliente */
    public $codigo = '';
    
    /** @var string Nombre completo del cliente */
    public $nombre = '';
    
    /** @var string Número de teléfono del cliente */
    public $numeroTelefono = '';
    
    /** @var int|null ID del cliente en edición (null si es creación) */
    public $editingId = null;

    /**
     * Reglas de validación para los campos del formulario
     * 
     * Define las restricciones y validaciones que deben cumplir
     * los datos antes de ser procesados y guardados.
     * 
     * @var array
     */
    protected $rules = [
        'codigo' => 'required|string|max:255',           // Código obligatorio, texto, máximo 255 caracteres
        'nombre' => 'required|string|max:255',           // Nombre obligatorio, texto, máximo 255 caracteres
        'numeroTelefono' => 'required|string|max:20',    // Teléfono obligatorio, texto, máximo 20 caracteres
    ];

    /**
     * Método de inicialización del componente
     * 
     * Se ejecuta automáticamente cuando el componente es montado
     * en la vista. Carga la lista inicial de clientes.
     * 
     * @return void
     */
    public function mount()
    {
        $this->loadClientes();
    }

    /**
     * Carga todos los clientes desde la base de datos
     * 
     * Obtiene la lista completa de clientes y la asigna a la
     * propiedad $clientes para su visualización en la vista.
     * 
     * @return void
     */
    public function loadClientes()
    {
        $this->clientes = Cliente::all();
    }

    /**
     * Guarda un cliente (nuevo o actualización)
     * 
     * Procesa el formulario de cliente, validando los datos y
     * determinando si se debe crear un nuevo registro o actualizar
     * uno existente basándose en el estado de $editingId.
     * 
     * @return void
     */
    public function save()
    {
        // Validar todos los campos según las reglas definidas
        $this->validate();

        // Preparar datos para guardar
        $clienteData = [
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'numeroTelefono' => $this->numeroTelefono,
        ];

        if ($this->editingId) {
            // Modo edición: actualizar cliente existente
            $cliente = Cliente::find($this->editingId);
            $cliente->update($clienteData);
            $this->editingId = null;
            $mensaje = 'Cliente actualizado exitosamente.';
        } else {
            // Modo creación: crear nuevo cliente
            Cliente::create($clienteData);
            $mensaje = 'Cliente creado exitosamente.';
        }

        // Limpiar formulario y recargar lista
        $this->reset(['codigo', 'nombre', 'numeroTelefono']);
        $this->loadClientes();
        
        // Mostrar mensaje de éxito al usuario
        session()->flash('message', $mensaje);
    }

    /**
     * Prepara un cliente para edición
     * 
     * Carga los datos del cliente seleccionado en el formulario
     * para permitir su modificación. Cambia el componente al
     * modo de edición.
     * 
     * @param int $id ID del cliente a editar
     * @return void
     */
    public function edit($id)
    {
        try {
            $cliente = Cliente::find($id);
            
            if ($cliente) {
                // Cargar datos del cliente en el formulario
                $this->editingId = $id;
                $this->codigo = $cliente->codigo;
                $this->nombre = $cliente->nombre;
                $this->numeroTelefono = $cliente->numeroTelefono;
            } else {
                session()->flash('error', 'Cliente no encontrado.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error al cargar el cliente: ' . $e->getMessage());
        }
    }

    /**
     * Elimina un cliente de la base de datos
     * 
     * Busca el cliente por su ID y lo elimina permanentemente
     * de la base de datos. Actualiza la lista después de la eliminación.
     * 
     * @param int $id ID del cliente a eliminar
     * @return void
     */
    public function delete($id)
    {
        try {
            $cliente = Cliente::find($id);
            
            if ($cliente) {
                $cliente->delete();
                $this->loadClientes();
                session()->flash('message', 'Cliente eliminado exitosamente.');
            } else {
                session()->flash('error', 'Cliente no encontrado.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar el cliente: ' . $e->getMessage());
        }
    }

    /**
     * Cancela la operación de edición
     * 
     * Limpia todos los campos del formulario y vuelve al modo
     * de creación, descartando cualquier cambio no guardado.
     * 
     * @return void
     */
    public function cancel()
    {
        // Limpiar todos los campos del formulario
        $this->reset(['codigo', 'nombre', 'numeroTelefono', 'editingId']);
        
        // Limpiar errores de validación
        $this->resetValidation();
    }

    /**
     * Renderiza la vista del componente
     * 
     * Retorna la vista Blade asociada a este componente Livewire
     * que contiene la interfaz de usuario para la gestión de clientes.
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.cliente-manager');
    }
}
